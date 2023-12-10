<?php
require_once("../connection/connection.php");
require_once("../model/ServiceIMP.php");
require_once("../model/Service.php");

// Verificar si se proporcionó un product_id en la URL
if (isset($_GET["service_id"])) {
    $serviceId = $_GET["service_id"];
    
    // Llamar a la función que selecciona un producto por su ID
    $specificService = selectServiceByID($pdo, $serviceId);
} else {
    echo "Service ID not provided.";
}

?>