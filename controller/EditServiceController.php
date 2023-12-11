<?php
require_once("../connection/connection.php");
require_once("../model/ServiceIMP.php");
require_once("../model/Service.php");

// Verificar si se proporcionó un service_id en el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["id"])) {
    $serviceId = $_POST["id"];
    $specificService = selectServiceByID($pdo, $serviceId);

    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->beginTransaction();

        $id = $_POST['id'];
        $categoryId = $_POST['categoryId'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        // Verificar la acción
        $action = $_POST['action'];

        if ($action === 'edit_service') {
            // Código para editar el servicio
            updateServiceByID($pdo, $serviceId);
        } elseif ($action === 'delete_service') {
            // Llamar a la función de borrado
            deleteServiceByID($pdo, $serviceId);
        }

        // Redirigir a la página de servicios después de editar o borrar
        require_once("../view/services.php");
        header("Location: ../view/services.php");
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Error de base de datos: " . $e->getMessage();
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

?>
