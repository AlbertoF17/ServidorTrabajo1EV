<?php
require_once(__DIR__."/../connection/connection.php");
require_once(__DIR__."/../model/Service.php");

function newService($pdo){
    if(isset($_POST['categoryID']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description']) && isset($_FILES['image']['tmp_name'])) {
        $categoryId = $_POST['categoryID'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image = fopen($_FILES['image']['tmp_name'], 'rb');

        $query = "INSERT INTO services (id, categoryId, name, price, description, image) VALUES (0, (?), (?), (?), (?), (?))";
        $step = $pdo->prepare($query);
        $step->bindParam(1, $categoryId, PDO::PARAM_INT);
        $step->bindParam(2, $name, PDO::PARAM_STR);
        $step->bindParam(3, $price, PDO::PARAM_STR);
        $step->bindParam(4, $description, PDO::PARAM_STR);
        $step->bindParam(5, $image, PDO::PARAM_LOB);

        if ($step->execute()) {
            echo "Data with Photo is added";
            header("Location: ../view/services.php");
        } else {
            echo "Not able to add data, please contact Admin";
            print_r($step->errorInfo()); 
        }
    }
}

function selectAllServices($pdo, $sortFilter, $orderFilter) {
    $query = "SELECT * FROM services ORDER BY $sortFilter $orderFilter";
    return fetchServices($pdo, $query);
}

function selectServicesByCategory($pdo, $category, $sortFilter, $orderFilter) {
    $query = "SELECT * FROM services WHERE categoryId = (?) ORDER BY $sortFilter $orderFilter";
    return fetchServices($pdo, $query, [$category]);
}

function fetchServices($pdo, $query, $params = []) {
    $results = [];
    $step = $pdo->prepare($query);
    $step->execute($params);

    foreach ($step->fetchAll() as $s) {
        $service = new Service($s["id"], "service", $s["categoryId"], $s["name"], $s["price"], $s["description"], $s["image"]);
        array_push($results, $service);
    }

    return $results;
}

function selectServiceByID($pdo, $serviceId) {
    $result = [];
    $query = "SELECT * FROM services WHERE id = (?)";
    $step = $pdo->prepare($query);
    $step->execute([$serviceId]);

    // Utiliza fetch en lugar de fetchAll
    $row = $step->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        $service = new Service($row["id"], "service", $row["categoryId"], $row["name"], $row["price"], $row["description"], $row["image"]);
    }
    return $service;
}

function deleteServiceByID($pdo, $serviceId) {
    try {
        $pdo->beginTransaction();

        // Eliminar el servicio
        $query = "DELETE FROM services WHERE id = (?)";
        $step = $pdo->prepare($query);
        $step->execute([$serviceId]);

        // Confirmar la transacción
        $pdo->commit();
        
    } catch (Exception $e) {
        // Ocurrió un error, revertir la transacción
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

function updateServiceByID($pdo, $serviceId) {
    try {
        $pdo->beginTransaction();

        // Eliminar el servicio
        $query = "UPDATE FROM services SET  WHERE id = (?)";
        $step = $pdo->prepare($query);
        $step->execute([$serviceId]);

        // Confirmar la transacción
        $pdo->commit();
        
    } catch (Exception $e) {
        // Ocurrió un error, revertir la transacción
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

?>