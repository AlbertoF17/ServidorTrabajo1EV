<?php
require_once(__DIR__."/../connection/connection.php");
require_once(__DIR__."/../model/ServiceIMP.php");
require_once(__DIR__."/../model/Service.php");

$newService = newService($pdo);

$categoryFilter = isset($_GET['categoryFilter']) ? $_GET['categoryFilter'] : 'all';
$sortFilter = isset($_GET['sortFilter']) ? $_GET['sortFilter'] : 'name';
$orderFilter = isset($_GET['orderFilter']) ? $_GET['orderFilter'] : 'asc';


switch ($categoryFilter) {
    case 'webDesign':
        $allServices = selectServicesByCategory($pdo, 4, $sortFilter, $orderFilter);
        break;
    case 'upgradePerformance':
        $allServices = selectServicesByCategory($pdo, 5, $sortFilter, $orderFilter);
        break;
    case 'drivers':
        $allServices = selectServicesByCategory($pdo, 6, $sortFilter, $orderFilter);
        break;
    case 'repair':
        $allServices = selectServicesByCategory($pdo, 7, $sortFilter, $orderFilter);
        break;
    case 'bugFix':
        $allServices = selectServicesByCategory($pdo, 8, $sortFilter, $orderFilter);
        break;
    case 'webMaintenance':
        $allServices = selectServicesByCategory($pdo, 9, $sortFilter, $orderFilter);
        break;
    default:
        $allServices = selectAllServices($pdo, $sortFilter, $orderFilter);
        break;
}


$pdo = null;
?>
