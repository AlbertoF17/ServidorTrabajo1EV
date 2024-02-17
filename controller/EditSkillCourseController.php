<?php
require_once("../connection/connection.php");
require_once("../model/SkillCourseIMP.php");
require_once("../model/SkillCourse.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["id"])) {
    $productId = $_POST["id"];
    $specificProduct = selectSkillCourseByID($pdo, $productId);

    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->beginTransaction();

        $id = $_POST['id'];
        $categoryId = $_POST['categoryId'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $imageTmpPath = $_FILES['image']['tmp_name'];

        if (!empty($imageTmpPath)) {
            $imageData = file_get_contents($imageTmpPath);
        } else {
            $imageData = $specificProduct->__get("image");
        }

        try {
            $pdo->beginTransaction();
    
            $query = "UPDATE skill_courses SET categoryId = (?), name = (?), price = (?), description = (?), image = (?) WHERE id = (?)";
            $step = $pdo->prepare($query);
            $step->bindParam(1, $categoryId, PDO::PARAM_INT);
            $step->bindParam(2, $name, PDO::PARAM_STR);
            $step->bindParam(3, $price, PDO::PARAM_STR);
            $step->bindParam(4, $description, PDO::PARAM_STR);
            $step->bindParam(5, $product->getImage(), PDO::PARAM_LOB);
            $step->bindParam(6, $id, PDO::PARAM_INT);
            $step->execute();
    
            // Confirmar la transacción
            $pdo->commit();
            
        } catch (Exception $e) {
            // Ocurrió un error, revertir la transacción
            $pdo->rollBack();
            echo "Error: " . $e->getMessage();
        }

        // Redirigir a la página de productos después de editar o borrar
        header("Location: ../view/skill_courses.php");
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