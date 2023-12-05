<?php
require_once("../connection/connection.php");
require_once("../model/EmployeeIMP.php");

$employees = selectAllEmployees($pdo);


$pdo = null;
?>