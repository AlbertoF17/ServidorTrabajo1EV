<?php
require_once("../connection/connection.php");
require_once("../model/User.php");
require_once("../model/Address.php");
require_once("../model/Cart.php");
session_start();

function getUserObject($pdo){
    $perfil_id = $_SESSION["user"]->id;
    $sql = "SELECT * FROM users WHERE id = (?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$perfil_id]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($resultado) {
        $address = new Address($resultado["streetNumber"], $resultado["street"], $resultado["city"], $resultado["region"],
        $resultado["country"], $resultado["postalCode"]);
        $usuarioPerfil = new User($resultado["id"], $resultado["username"], $resultado["email"], $resultado["phoneNumber"],
        $resultado["password"], $address, $resultado["createDate"]);
    } else {
        header("Location: ../errors/Error.php?message=" . $e->getMessage());
        exit();
    }
    return $usuarioPerfil;
}

function isLoggedProfile($pdo){
    $perfil_id = getUserObject($pdo)->__get("id");
    return ($perfil_id == $_SESSION["user"]->id);
}

function fetchCarts($pdo) {
    $cartList = [];

    $perfil_id = $_SESSION["user"]->id;
    $sql = "SELECT id FROM shopping_carts WHERE user_id = (?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$perfil_id]);
    $carts = $stmt->fetchAll(PDO::FETCH_COLUMN);

    foreach ($carts as $cart) {
        $productList = [];

        // Fetch the date from purchases table
        $purchaseSql = "SELECT date FROM purchases WHERE cart_id = (?)";
        $purchaseStmt = $pdo->prepare($purchaseSql);
        $purchaseStmt->execute([$cart]);
        $purchaseDate = $purchaseStmt->fetchColumn();

        // Add date to the cart data
        $cartData["date"] = $purchaseDate;

        $sql = "SELECT * FROM products_in_cart WHERE cart_id = (?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$cart]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($items as $item) {
            $product = [];

            if ($item["type_id"] == 1) {
                $sql = "SELECT name, price, image FROM products WHERE id = (?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$item["product_id"]]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
            } elseif ($item["type_id"] == 2) {
                $sql = "SELECT name, price, image FROM services WHERE id = (?)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$item["product_id"]]);
                $product = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            $productList[] = $product;
        }

        // Add product list and date to the cart list
        $cartData["products"] = $productList;

        // Create an instance of the Cart class
        $cartInstance = new Cart(
            $cart,
            $cartData["products"], // Assuming $cartData["products"] is an array of products
            [], // Assuming $cartData["services"] is an array of services
            0, // You may calculate the total price based on the products and services
            $cartData["date"]
        );

        $cartList[] = $cartInstance;
    }

    return $cartList;
}

?>