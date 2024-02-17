<?php
require_once("../connection/connection.php");
require_once("../model/EmployeeIMP.php");
// require_once("../model/UserIMP.php");
// require_once("../model/User.php");

$employees = selectAllEmployees($pdo);

// $userObject = getUserObject($pdo);

$pdo = null;
?>