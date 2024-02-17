<?php
require_once(__DIR__."/../connection/connection.php");

function newSkillCourse($pdo){
    if(isset($_POST['categoryID']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description']) && isset($_FILES['image']['tmp_name'])) {
        $categoryId = $_POST['categoryID'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image = fopen($_FILES['image']['tmp_name'], 'rb');

        $query = "INSERT INTO skill_courses (id, categoryId, name, price, description, image) VALUES (0, (?), (?), (?), (?), (?))";
        $step = $pdo->prepare($query);
        $step->bindParam(1, $categoryId, PDO::PARAM_INT);
        $step->bindParam(2, $name, PDO::PARAM_STR);
        $step->bindParam(3, $price, PDO::PARAM_STR);
        $step->bindParam(4, $description, PDO::PARAM_STR);
        $step->bindParam(5, $image, PDO::PARAM_LOB);

        if ($step->execute()) {
            echo "Data with Photo is added";
            header("Location: ../view/skill_courses.php");
        } else {
            echo "Not able to add data, please contact Admin";
            print_r($step->errorInfo()); 
        }
    }
}

function selectAllSkillCourses($pdo, $sortFilter, $orderFilter) {
    $query = "SELECT * FROM skill_courses ORDER BY $sortFilter $orderFilter";
    return fetchSkillCourses($pdo, $query);
}

function selectSkillCoursesByCategory($pdo, $category, $sortFilter, $orderFilter) {
    $query = "SELECT * FROM skill_courses WHERE categoryId = (?) ORDER BY $sortFilter $orderFilter";
    return fetchskill_courses($pdo, $query, [$category]);
}

function fetchSkillCourses($pdo, $query, $params = []) {
    $results = [];
    $step = $pdo->prepare($query);
    $step->execute($params);

    foreach ($step->fetchAll() as $p) {
        $product = new SkillCourse($p["id"], "product", $p["categoryId"], $p["name"], $p["price"], $p["description"], $p["image"]);
        array_push($results, $product);
    }

    return $results;
}

function selectSkillCourseByID($pdo, $productId) {
    $result = [];
    $query = "SELECT * FROM skill_courses WHERE id = (?)";
    $step = $pdo->prepare($query);
    $step->execute([$productId]);

    // Utiliza fetch en lugar de fetchAll
    $row = $step->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // Crea un objeto Product con los valores de la fila
        $product = new SkillCourse($row["id"], "product", $row["categoryId"], $row["name"], $row["price"], $row["description"], $row["image"]);
    }
    return $product;
}

function deleteSkillCourseByID($pdo, $productId) {
    try {
        $pdo->beginTransaction();

        // Eliminar el producto
        $query = "DELETE FROM skill_courses WHERE id = (?)";
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

function updateSkillCourseByID($pdo, $productId) {
    
}

?>