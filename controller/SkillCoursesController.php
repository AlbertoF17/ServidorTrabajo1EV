<?php
require_once("../connection/connection.php");
require_once("../model/SkillCourseIMP.php");
require_once("../model/SkillCourse.php");

$newProduct = newSkillCourse($pdo);

$categoryFilter = isset($_GET['categoryFilter']) ? $_GET['categoryFilter'] : 'all';
$sortFilter = isset($_GET['sortFilter']) ? $_GET['sortFilter'] : 'name';
$orderFilter = isset($_GET['orderFilter']) ? $_GET['orderFilter'] : 'asc';

// Realizar consultas según las opciones seleccionadas
switch ($categoryFilter) {
    case 'database':
        $allProducts = selectSkillCoursesByCategory($pdo, 1, $sortFilter, $orderFilter);
        break;
    case 'cybersecurity':
        $allProducts = selectSkillCoursesByCategory($pdo, 2, $sortFilter, $orderFilter);
        break;
    case 'business':
        $allProducts = selectSkillCoursesByCategory($pdo, 3, $sortFilter, $orderFilter);
        break;
    case 'marketing':
        $allProducts = selectSkillCoursesByCategory($pdo, 4, $sortFilter, $orderFilter);
        break;
    default:
        $allProducts = selectAllSkillCourses($pdo, $sortFilter, $orderFilter);
        break;
}

$pdo = null;
?>
