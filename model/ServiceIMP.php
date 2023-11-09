<?php
require_once(__DIR__."/../connection/connection.php");

function newService($pdo){
    if(isset($_POST['categoryID']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description']) && isset($_FILES['image']['tmp_name'])) {
        $categoryId = $_POST['categoryID'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image = fopen($_FILES['image']['tmp_name'], 'rb');

        $query = "INSERT INTO services (id, categoryId, name, price, description, image) VALUES (0, :categoryId, :name, :price, :description, :image)";
        $step = $pdo->prepare($query);
        $step->bindParam(':categoryId', $categoryId, PDO::PARAM_INT);
        $step->bindParam(':name', $name, PDO::PARAM_STR);
        $step->bindParam(':price', $price, PDO::PARAM_STR);
        $step->bindParam(':description', $description, PDO::PARAM_STR);
        $step->bindParam(':image', $image, PDO::PARAM_LOB);

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
    $query = "SELECT * FROM services WHERE categoryId = :category";
    $step = $pdo->prepare($query);
    $step->bindParam(':category', $category, PDO::PARAM_INT);
    $step->execute();
    foreach ($step->fetchAll() as $p) {
        $service = new Service($p["id"], $p["categoryId"], $p["name"], $p["price"], $p["description"], $p["image"]);
        array_push($results, $service);
    }
    return $results;
}
?>