<?php
require_once("../connection/connection.php");
require_once("../model/SkillCourse.php");
require_once("../model/BusinessService.php");
require_once("../model/User.php");
require_once("../model/Address.php");
session_start();

function addToCart($elementId, $pdo, $elementType) {
    // Obtener el carrito actual de las cookies
    $cart = isset($_COOKIE["cart"]) ? json_decode($_COOKIE["cart"], true) : [];

    // Determinar la tabla y los campos según el tipo de elemento
    $table = ($elementType === "product") ? "products" : "services";

    $stmt = $pdo->prepare("SELECT * FROM $table WHERE id = (?)");
    $stmt->execute([$elementId]);
    $elementProperties = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Verificar si el elemento ya está en el carrito
    $found = false;
    foreach ($cart as &$item) {
        if ($item["id"] === $elementId && $item["type"] === $elementType) {
            $item["quantity"]++;
            $found = true;
            break;
        }
    }
    unset($item);

    // Si no se encontró, agregar un nuevo item al carrito
    if (!$found) {
        $newItem = [
            "id" => $elementId,
            "type" => $elementType,
            "name" => $elementProperties["name"],
            "price" => $elementProperties["price"],
            "description" => $elementProperties["description"],
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

function removeFromCart($elementId, $elementType) {
    // Obtener el carrito actual de las cookies
    $cart = isset($_COOKIE["cart"]) ? json_decode($_COOKIE["cart"], true) : [];

    // Buscar el elemento en el carrito
    foreach ($cart as $key => $item) {
        if ($cart[$key]["id"] == $elementId && $cart[$key]["type"] == $elementType) {
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
    $cart = isset($_COOKIE["cart"]) ? json_decode($_COOKIE["cart"]) : [];

    // Realizar acciones para confirmar la compra en la base de datos
    try {
        $pdo->beginTransaction();
    
        // Insertar un nuevo carrito de compras
        $query = "INSERT INTO shopping_carts VALUES (0, (?))";
        $step = $pdo->prepare($query);
        $step->bindValue(1, $_SESSION["user"]->__get("id"));
        $step->execute();
        echo "Nuevo carrito de compras insertado.";

        // Obtener el número del carrito de compras recién insertado
        $query = "SELECT LAST_INSERT_ID()";
        $step = $pdo->query($query);
        $cartNumber = $step->fetchColumn();
        echo "Número de carrito: " . $cartNumber;
    
        // Insertar elementos en el carrito
        foreach ($cart as $item) {
            $query = "SELECT type_id FROM categories WHERE id = ?";
            $statement = $pdo->prepare($query);
            $statement->bindParam(1, $item->categoryId);
            $statement->execute();
            $type = $statement->fetchColumn();
            echo "Type ID obtenido: " . $type;

            $query = "INSERT INTO products_in_cart VALUES (0, (?), (?), (?))";
            $step = $pdo->prepare($query);
            $step->bindParam(1, $cartNumber);
            $step->bindParam(2, $type);
            $step->bindParam(3, $item->id);
            $step->execute();
            echo "Elemento insertado en el carrito.";
        }
    
        // Insertar un registro de compra
        $query = "INSERT INTO purchases VALUES (0, (?), CURDATE())";
        $step = $pdo->prepare($query);
        $step->bindParam(1, $cartNumber);
        $step->execute();
        echo "Registro de compra insertado.";
    
        // Confirmar la transacción
        $pdo->commit();
        echo "Transacción confirmada.";

    } catch (Exception $e) {
        // Ocurrió un error, revertir la transacción
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
    
    // Borrar la cookie del carrito después de confirmar la compra
    setcookie("cart", "", time() - 3600, "/");
}
