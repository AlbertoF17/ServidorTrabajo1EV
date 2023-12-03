<?php
require_once("../connection/connection.php");

function getUserObject($pdo){
    $perfil_id = $_SESSION["usuario"]->id;
    $sql = "SELECT * FROM users WHERE id = (?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$perfil_id]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($resultado) {
        $address = new Address($resultado["streetNumber"], $resultado["street"], $resultado["city"], $resultado["region"],
        $resultado["country"], $resultado["postalCode"]);
        $usuarioPerfil = new User($resultado["id"], $resultado["username"], $resultado["email"], $resultado["phoneNumber"],
        $resultado["password"], $address, $resultado["createDate"]);
    } else {
        header("Location: ../errors/Error.php?message=" . $e->getMessage());
        exit();
    }
    return $usuarioPerfil;
}

function isLoggedProfile($pdo){
    $perfil_id = getUserObject($pdo)->__get("id");
    return ($perfil_id == $_SESSION["usuario"]->id);
}

?>