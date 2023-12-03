<?php
    require_once __DIR__ . "/../connection/connection.php";
    require_once __DIR__ . "/../model/User.php";
    require_once __DIR__ . "/../model/Address.php";
    session_start();

    if (isset($_SESSION["usuario"])) {
        $userObject = $_SESSION["usuario"];
        require_once __DIR__ . "/../view/profile.php";
    } else {
        header("Location: ../view/login.php");
        exit();
    }


$pdo = null;

?>