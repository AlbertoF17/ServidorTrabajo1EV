<?php
require_once(__DIR__."/../connection/connection.php");
require_once(__DIR__."/../model/BusinessServiceIMP.php");
require_once(__DIR__."/../model/BusinessService.php");

$newService = newBusinessService($pdo);

$categoryFilter = isset($_GET['categoryFilter']) ? $_GET['categoryFilter'] : 'all';
$sortFilter = isset($_GET['sortFilter']) ? $_GET['sortFilter'] : 'name';
$orderFilter = isset($_GET['orderFilter']) ? $_GET['orderFilter'] : 'asc';


switch ($categoryFilter) {
    case 'database':
        $allServices = selectBusinessServicesByCategory($pdo, 5, $sortFilter, $orderFilter);
        break;
    case 'web':
        $allServices = selectBusinessServicesByCategory($pdo, 6, $sortFilter, $orderFilter);
        break;
    case 'service':
        $allServices = selectBusinessServicesByCategory($pdo, 7, $sortFilter, $orderFilter);
        break;
    case 'officeSuit':
        $allServices = selectBusinessServicesByCategory($pdo, 8, $sortFilter, $orderFilter);
        break;
    default:
        $allServices = selectAllBusinessServices($pdo, $sortFilter, $orderFilter);
        break;
}


$pdo = null;
?>
