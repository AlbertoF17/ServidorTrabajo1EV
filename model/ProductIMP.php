<?php
require_once(__DIR__."/../connection/connection.php");

function newProduct($pdo){
    if(isset($_POST['categoryID']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description']) && isset($_FILES['image']['tmp_name'])) {
        $categoryId = $_POST['categoryID'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image = fopen($_FILES['image']['tmp_name'], 'rb');

        $query = "INSERT INTO products (id, categoryId, name, price, description, image) VALUES (0, (?), (?), (?), (?), (?))";
        $step = $pdo->prepare($query);
        $step->bindParam(1, $categoryId, PDO::PARAM_INT);
        $step->bindParam(2, $name, PDO::PARAM_STR);
        $step->bindParam(3, $price, PDO::PARAM_STR);
        $step->bindParam(4, $description, PDO::PARAM_STR);
        $step->bindParam(5, $image, PDO::PARAM_LOB);

        if ($step->execute()) {
            echo "Data with Photo is added";
            header("Location: ../view/products.php");
        } else {
            echo "Not able to add data, please contact Admin";
            print_r($step->errorInfo()); 
        }
    }
}

function selectAllProducts($pdo){
    $results = [];
    $query = "SELECT * FROM products";
    $step = $pdo->prepare($query);
    $step->execute();
    foreach ($step->fetchAll() as $p) {
        $product = new Product($p["id"], $p["categoryId"], $p["name"], $p["price"], $p["description"], $p["image"]);
        array_push($results, $product);
    }
    return $results;
}

function selectProductsByCategory($pdo, $category){
    $results = [];
    $query = "SELECT * FROM products WHERE categoryId = (?)";
    $step = $pdo->prepare($query);
    $step->execute([$category]);
    foreach ($step->fetchAll() as $p) {
        $product = new Product($p["id"], $p["categoryId"], $p["name"], $p["price"], $p["description"], $p["image"]);
        array_push($results, $product);
    }
    return $results;
}

function selectProductByID($pdo, $productId) {
    $result = [];
    $query = "SELECT * FROM products WHERE id = (?)";
    $step = $pdo->prepare($query);
    $step->execute([$productId]);

    // Utiliza fetch en lugar de fetchAll
    $row = $step->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Crea un objeto Product con los valores de la fila
        $product = new Product($row["id"], $row["categoryId"], $row["name"], $row["price"], $row["description"], $row["image"]);
    }
    return $product;
}
?>