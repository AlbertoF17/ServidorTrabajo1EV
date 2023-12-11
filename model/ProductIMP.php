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

function selectAllProducts($pdo, $sortFilter, $orderFilter) {
    $query = "SELECT * FROM products ORDER BY $sortFilter $orderFilter";
    return fetchProducts($pdo, $query);
}

function selectProductsByCategory($pdo, $category, $sortFilter, $orderFilter) {
    $query = "SELECT * FROM products WHERE categoryId = (?) ORDER BY $sortFilter $orderFilter";
    return fetchProducts($pdo, $query, [$category]);
}

function fetchProducts($pdo, $query, $params = []) {
    $results = [];
    $step = $pdo->prepare($query);
    $step->execute($params);

    foreach ($step->fetchAll() as $p) {
        $product = new Product($p["id"], "product", $p["categoryId"], $p["name"], $p["price"], $p["description"], $p["image"]);
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
        $product = new Product($row["id"], "product", $row["categoryId"], $row["name"], $row["price"], $row["description"], $row["image"]);
    }
    return $product;
}

function deleteProductByID($pdo, $productId) {
    try {
        $pdo->beginTransaction();

        // Eliminar el producto
        $query = "DELETE FROM products WHERE id = (?)";
        $step = $pdo->prepare($query);
        $step->execute([$productId]);

        // Confirmar la transacción
        $pdo->commit();
        
    } catch (Exception $e) {
        // Ocurrió un error, revertir la transacción
        $pdo->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

function updateProductByID($pdo, $productId) {
    
}

?>