<?php
require_once("../connection/connection.php");

function getUserObject($pdo){
    $usuarioPerfil = null;
    $perfil_id = null;
    if(isset($_GET["id"])){
        $perfil_id = $_GET["id"];
    } else {
        $perfil_id = $_SESSION["usuario"]->__get("id");
    }
    $sql = "SELECT * FROM users WHERE id = :perfil_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':perfil_id', $perfil_id);
    $stmt->execute();
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($resultado) {
        $address = new Address($resultado["apartmentNumber"], $resultado["street"], $resultado["city"], $resultado["region"],
        $resultado["country"], $resultado["postalCode"]);
        $usuarioPerfil = new User($resultado["id"], $resultado["username"], $resultado["email"], $resultado["phoneNumber"],
        $resultado["password"], $address, $resultado["createDate"]);
    } else {
        header("Location: ../errors/error.php");
        exit();
    }
    return $usuarioPerfil;
}

// function getUserTweets($pdo, User $user){
//     $user = getUserObject($pdo);
//     if ($user === null) {
//         header("Location: error.php");
//         exit();
//     }
//     $sql_tweets = "SELECT * FROM publications WHERE userId = :perfil_id";
//     $stmt_tweets = $pdo->prepare($sql_tweets);
//     $profileId = $user->__get("id");
//     $stmt_tweets->bindParam(':perfil_id', $profileId);
//     $stmt_tweets->execute();
//     $tweets_perfil = array();
//     $resultado_tweets = $stmt_tweets->fetchAll(PDO::FETCH_ASSOC);

//     if ($resultado_tweets) {
//         foreach ($resultado_tweets as $tweet) {
//             $tuit = new Publication($tweet["id"], $user, $tweet["text"], $tweet["createDate"]);
//             array_push($tweets_perfil, $tuit);
//         }
//     }
//     return array_reverse($tweets_perfil);
// }

function isLoggedProfile($pdo){
    $perfil_id = getUserObject($pdo)->__get("id");
    return ($perfil_id == $_SESSION["usuario"]->id);
}

?>