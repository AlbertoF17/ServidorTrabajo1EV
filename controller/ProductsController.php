<?php
require_once("../connection/connection.php");
require_once("../model/ProductIMP.php");
require_once("../model/Product.php");

$newProduct = newProduct($pdo);

$allProducts = selectAllProducts($pdo);

$components = selectProductsByCategory($pdo, 1);

$peripherals = selectProductsByCategory($pdo, 2);

$keys = selectProductsByCategory($pdo, 3);

$pdo = null;
?>
