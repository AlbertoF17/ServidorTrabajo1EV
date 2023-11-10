<?php
require_once("../connection/connection.php");
require_once("../model/UserIMP.php");

$pdo = connection($host, $user, $pass, $bd);

$userObject = getUserObject($pdo);

$pdo = null;

?>