<?php
require_once("../connection/connection.php");
require_once("../model/ProductIMP.php");
require_once("../model/Product.php");

$newProduct = newProduct($pdo);

$categoryFilter = isset($_GET['categoryFilter']) ? $_GET['categoryFilter'] : 'all';
$sortFilter = isset($_GET['sortFilter']) ? $_GET['sortFilter'] : 'name';
$orderFilter = isset($_GET['orderFilter']) ? $_GET['orderFilter'] : 'asc';

// Realizar consultas según las opciones seleccionadas
switch ($categoryFilter) {
    case 'components':
        $allProducts = selectProductsByCategory($pdo, 1, $sortFilter, $orderFilter);
        break;
    case 'peripherals':
        $allProducts = selectProductsByCategory($pdo, 2, $sortFilter, $orderFilter);
        break;
    case 'keys':
        $allProducts = selectProductsByCategory($pdo, 3, $sortFilter, $orderFilter);
        break;
    default:
        $allProducts = selectAllProducts($pdo, $sortFilter, $orderFilter);
        break;
}

$pdo = null;
?>
