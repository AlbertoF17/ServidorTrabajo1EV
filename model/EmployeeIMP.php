<?php
require_once("../connection/connection.php");
require_once("../model/Employee.php");

function selectAllEmployees($pdo){
    $results = [];
    $query = "SELECT * FROM employees";
    $step = $pdo->prepare($query);
    $step->execute();
    foreach ($step->fetchAll() as $p) {
        $employee = new Employee($p["id"], $p["FirstName"], $p["LastName"], $p["title"]);
        array_push($results, $employee);
    }
    return $results;
}


?>