<?php
require_once("../connection/connection.php");
require_once("../model/SkillCourse.php");
require_once("../model/SkillCourseIMP.php");

if (isset($_GET["product_id"])) {
    $productId = $_GET["product_id"];
    $specificProduct = selectSkillCourseByID($pdo, $productId);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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

        if ($action === 'edit_product') {
            // Redirigir a la página de edición con el ID del producto
            header("Location: ../view/editProduct.php?product_id={$_GET["product_id"]}");
            exit();
        } elseif ($action === 'delete_product') {
            // Llamar a la función de borrado
            deleteSkillCourseByID($pdo, $productId);
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