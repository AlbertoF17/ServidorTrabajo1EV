<?php
require_once("../connection/connection.php");
require_once("../model/UserIMP.php");

$userObject = getUserObject($pdo);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->beginTransaction();

        // Obtener los datos del formulario
        $userName = $_POST['userName'];
        $email = $_POST['email'];
        $phoneNumber = $_POST['phoneNumber'];

        // Actualizar el usuario en la base de datos
        $sql = "UPDATE users SET username = ?, email = ?, phoneNumber = ? WHERE email = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $userName, PDO::PARAM_STR);
        $stmt->bindParam(2, $email, PDO::PARAM_STR);
        $stmt->bindParam(3, $phoneNumber, PDO::PARAM_STR);
        $stmt->bindParam(4, $userObject->__get("email"), PDO::PARAM_STR);
        $stmt->execute();

        // Confirmar la transacción
        $pdo->commit();

        header("Location: ../view/profile.php");
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