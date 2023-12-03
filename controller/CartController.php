<?php
require_once("../connection/connection.php");
require_once("../model/CartIMP.php");

if (isset($_GET["add_to_cart"])) {
    $productId = $_GET["add_to_cart"];
    addToCart($productId, $pdo);
} elseif (isset($_GET["remove_from_cart"])) {
    $productId = $_GET["remove_from_cart"];
    removeFromCart($productId);
} elseif (isset($_GET["clear_cart"])) {
    clearCart();
} elseif (isset($_GET["confirm_purchase"])) {
    confirmPurchase($pdo);  
}

header("Location: ../view/products.php");
?>