<?php
require_once("../connection/connection.php");
require_once("../model/CartIMP.php");

if (isset($_GET["type"])) {
    $elementType = $_GET["type"];
    if (isset($_GET["add_to_cart"])) {
        $productId = $_GET["add_to_cart"];
        addToCart($productId, $pdo, $elementType);
        $pdo = null;
        header("Location: ../view/{$_GET["type"]}s.php");
    } elseif (isset($_GET["remove_from_cart"])) {
        $productId = $_GET["remove_from_cart"];
        removeFromCart($productId, $elementType);
    }
}

if (isset($_GET["clear_cart"])) {
    clearCart();
    header("Location: ../view/products.php");
}

if (isset($_GET["confirm_purchase"])) {
    confirmPurchase($pdo);
    $pdo = null;
    header("Location: ../view/profile.php");
}

$pdo = null;

?>