<?php
require_once("../connection/connection.php");
require_once("../model/ServiceIMP.php");
require_once("../model/Service.php");

$newService = newService($pdo);

$allServices = selectAllServices($pdo);

$webDesign = selectServicesByCategory($pdo, 4);

$upgradePreformance = selectServicesByCategory($pdo, 5);

$drivers = selectServicesByCategory($pdo, 6);

$repair = selectServicesByCategory($pdo, 7);

$bugFix = selectServicesByCategory($pdo, 8);

$webManteinance = selectServicesByCategory($pdo, 9);

$pdo = null;
?>
