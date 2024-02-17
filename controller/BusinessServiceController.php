<?php
require_once("../connection/connection.php");
require_once("../model/BusinessServiceIMP.php");
require_once("../model/BusinessService.php");

// Verificar si se proporcionó un service_id en la URL
if (isset($_GET["service_id"])) {
    $serviceId = $_GET["service_id"];

    // Llamar a la función que selecciona un servicio por su ID
    $specificService = selectBusinessServiceByID($pdo, $serviceId);

    // Comprobar si se envió el formulario de eliminación
    if (isset($_POST['delete_service'])) {
        // Llamar a la función que elimina el servicio
        deleteServiceByID($pdo, $serviceId);
        // Redirigir a la página de servicios después de la eliminación
        header("Location: ../view/business_services.php");
        exit();
    }
} else {
    echo "Service ID not provided.";
}

?>