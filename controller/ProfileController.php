<?php
require_once __DIR__ . "/../connection/connection.php";
require_once __DIR__ . "/../model/User.php";
require_once __DIR__ . "/../model/Address.php";
require_once __DIR__ . "/../model/UserIMP.php";

if (isset($_SESSION["user"])) {
    $userObject = $_SESSION["user"];
    require_once __DIR__ . "/../view/profile.php";
} else {
    header("Location: ../view/login.php");
    exit();
}


$pdo = null;

?>