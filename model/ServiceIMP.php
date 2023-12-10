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

function selectAllServices($pdo){
    $results = [];
    $query = "SELECT * FROM services";
    $step = $pdo->prepare($query);
    $step->execute();
    foreach ($step->fetchAll() as $p) {
        $service = new Service($p["id"], $p["categoryId"], $p["name"], $p["price"], $p["description"], $p["image"]);
        array_push($results, $service);
    }
    return $results;
}

function selectServicesByCategory($pdo, $category){
    $results = [];
    $query = "SELECT * FROM services WHERE categoryId = (?)";
    $step = $pdo->prepare($query);
    $step->bindParam(1, $category, PDO::PARAM_INT);
    $step->execute();
    foreach ($step->fetchAll() as $p) {
        $service = new Service($p["id"], $p["categoryId"], $p["name"], $p["price"], $p["description"], $p["image"]);
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
        // Crea un objeto Product con los valores de la fila
        $service = new Service($row["id"], $row["categoryId"], $row["name"], $row["price"], $row["description"], $row["image"]);
    }
    return $service;
}
?>