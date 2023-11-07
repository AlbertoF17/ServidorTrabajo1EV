<?php 

function connection($host, $user, $pass, $bd) {
    return new PDO("mysql:host=$host;dbname=$bd", $user, $pass);
}

try {
    $host = "localhost:3306";
    $user = "root";
    $pass = "root";

    $bd = "online_shop";

    $pdo = connection($host, $user, $pass, $bd);

}  catch (PDOException $e) {
    header("Location: ../errors/Error.php?message=" . $e->getMessage());
}
?>