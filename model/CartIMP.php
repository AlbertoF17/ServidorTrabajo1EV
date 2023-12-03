<?php
require_once("../connection/connection.php");
require_once("../model/Product.php");

function addToCart($productId, $pdo) {
    // Obtener el carrito actual de las cookies
    $cart = isset($_COOKIE["my_cart"]) ? json_decode($_COOKIE["my_cart"]) : [];

    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = (?)");
    $stmt->execute([$productId]);
    $productProperties = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el producto ya está en el carrito
    $found = false;
    foreach ($cart as &$item) {
        if ($item["id"] === $productId) {
            $item["quantity"]++;
            $found = true;
            break;
        }
    }

    // Si no se encontró, agregar un nuevo item al carrito
    if (!$found) {
        $newItem = [
            "id" => $productProperties["id"],
            "categoryId" => $productProperties["categoryId"],
            "name" => $productProperties["name"],
            "price" => $productProperties["price"],
            "description" => $productProperties["description"],
            "image" => $productProperties["image"],
            "quantity" => 1
        ];
        $cart[] = $newItem;
    }

    setcookie("my_cart", json_encode($cart), time() + (86400 * 30), "/");

}


function removeFromCart($productId) {
    // Obtener el carrito actual de las cookies
    $cart = isset($_COOKIE["my_cart"]) ? json_decode($_COOKIE["my_cart"], true) : [];

    // Buscar el producto en el carrito
    foreach ($cart as $key => $item) {
        if ($item["product"]["id"] === $productId) {
            // Reducir la cantidad o eliminar el item si la cantidad es 1
            if ($item["quantity"] > 1) {
                $cart[$key]["quantity"]--;
            } else {
                unset($cart[$key]);
            }
            break;
        }
    }

    // Guardar el carrito actualizado en las cookies
    setcookie("my_cart", json_encode(array_values($cart)), time() + (86400 * 30), "/");
}


function clearCart() {
    // Borrar la cookie del carrito
    setcookie("my_cart", "", time() - 3600, "/");
}

function confirmPurchase($pdo) {
    // Obtener el carrito actual de las cookies
    $cart = isset($_COOKIE["my_cart"]) ? json_decode($_COOKIE["my_cart"], true) : [];

    // Realizar acciones para confirmar la compra en la base de datos
    // ...

    // Borrar la cookie del carrito después de confirmar la compra
    setcookie("my_cart", "", time() - 3600, "/");
}
?>