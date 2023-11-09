<?php
require_once("../connection/connection.php");
require_once("../model/ServiceIMP.php");
require_once("../model/Service.php");

$newService = newService($pdo);

$allServices = selectAllServices($pdo);

$components = selectProductsByCategory($pdo, 1);

$peripherals = selectProductsByCategory($pdo, 2);

$keys = selectProductsByCategory($pdo, 3);

$pdo = null;
?>
