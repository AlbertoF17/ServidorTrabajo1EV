<?php
require_once(__DIR__."/../connection/connection.php");
require_once(__DIR__."/../model/ServiceIMP.php");
require_once(__DIR__."/../model/Service.php");

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
