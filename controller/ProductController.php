<?php
require_once("../connection/connection.php");
require_once("../model/ProductIMP.php");
require_once("../model/Product.php");

// Verificar si se proporcionó un product_id en la URL
if (isset($_GET["product_id"])) {
    $productId = $_GET["product_id"];
    
    // Llamar a la función que selecciona un producto por su ID
    $specificProduct = selectProductByID($pdo, $productId);
} else {
    echo "Product ID not provided.";
}

?>