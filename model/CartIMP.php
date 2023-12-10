<?php
require_once("../connection/connection.php");
require_once("../model/Product.php");
require_once("../model/User.php");
require_once("../model/Address.php");
session_start();

function addToCart($productId, $pdo) {
    // Obtener el carrito actual de las cookies
    $cart = isset($_COOKIE["cart"]) ? json_decode($_COOKIE["cart"], true) : [];

    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = (?)");
    $stmt->execute([$productId]);
    $productProperties = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el producto ya está en el carrito
    $found = false;
    foreach ($cart as &$item) {
        if ($item["id"] == $productId) {
            $item["quantity"]++;
            $found = true;
            break;
        }
    }
    unset($item);

    // Si no se encontró, agregar un nuevo item al carrito
    if (!$found) {
        $newItem = [
            "id" => $productProperties["id"],
            "categoryId" => $productProperties["categoryId"],
            "name" => $productProperties["name"],
            "price" => $productProperties["price"],
            "description" => $productProperties["description"],
            "quantity" => 1
        ];

        // Agregar el nuevo item al carrito
        $cart[] = $newItem;
    }

    $encodedCart = json_encode(array_values($cart));

    if (json_last_error() !== JSON_ERROR_NONE) {
        die('JSON encoding error: ' . json_last_error_msg());
    }

    // Actualizar la cookie con el carrito actualizado
    setcookie("cart", $encodedCart, time() + 3600, "/");
}

function clearCart() {
    // Borrar la cookie del carrito
    setcookie("cart", "", time() - 3600, "/");
}

function removeFromCart($productId) {
    // Obtener el carrito actual de las cookies
    $cart = isset($_COOKIE["cart"]) ? json_decode($_COOKIE["cart"], true) : [];

    // Buscar el producto en el carrito
    foreach ($cart as $key => $item) {
        if ($cart[$key]["id"] == $productId) {
            // Reducir la cantidad o eliminar el item si la cantidad es 1
            if ($cart[$key]["quantity"] > 1) {
                $cart[$key]["quantity"]--;
            } else {
                unset($cart[$key]);
            }
            break;
        }
    }

    // Guardar el carrito actualizado en las cookies
    setcookie("cart", json_encode(array_values($cart)), time() + 3600, "/");
}

function confirmPurchase($pdo) {
    // Obtener el carrito actual de las cookies
    $cart = isset($_COOKIE["cart"]) ? json_decode($_COOKIE["cart"], true) : [];

    // Realizar acciones para confirmar la compra en la base de datos
    try {
        $pdo->beginTransaction();
    
        // Insert a new shopping cart
        $query = "INSERT INTO shopping_carts VALUES (0, (?))";
        $step = $pdo->prepare($query);
        $step->bindValue(1, $_SESSION["user"]->__get("id"));
        $step->execute();

        // Get the newly inserted shopping cart number
        $cartNumberQuery = "SELECT LAST_INSERT_ID()";
        $cartNumberStatement = $pdo->query($cartNumberQuery);
        $cartNumber = $cartNumberStatement->fetchColumn();
    
        // Insert products into the cart
        foreach ($cart as $key => $item) {
            $categoryQuery = "SELECT type_id FROM categories WHERE id = (?)";
            $categoryStatement = $pdo->prepare($categoryQuery);
            $categoryStatement->bindParam(1, $item["categoryId"]);
            $categoryStatement->execute();
            $type = $categoryStatement->fetchColumn();

            $productInCartQuery = "INSERT INTO products_in_cart VALUES (0, (?), (?), (?))";
            $productInCartStatement = $pdo->prepare($productInCartQuery);
            $productInCartStatement->bindParam(1, $cartNumber);
            $productInCartStatement->bindParam(2, $type);
            $productInCartStatement->bindParam(3, $item["id"]);
            $productInCartStatement->execute();
        }

    
        // Insert a purchase record
        $purchaseQuery = "INSERT INTO purchases VALUES (0, (?), CURDATE())";
        $purchaseStatement = $pdo->prepare($purchaseQuery);
        $purchaseStatement->bindParam(1, $cartNumber);
        $purchaseStatement->execute();
    
        // Commit the transaction
        $pdo->commit();
        
    } catch (Exception $e) {
        // An error occurred, rollback the transaction
        $pdo->rollBack();
        echo "Failed: " . $e->getMessage();
    }
    
    // Borrar la cookie del carrito después de confirmar la compra
    setcookie("cart", "", time() - 3600, "/");
}