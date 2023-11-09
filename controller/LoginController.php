<?php
    require_once __DIR__ . "/../connection/connection.php";
    require_once __DIR__ . "/../model/User.php";
    require_once __DIR__ . "/../model/Address.php";
    session_start();

    if (isset($_POST["submit"])) {
        $email = isset($_POST["email"]) ? trim($_POST["email"]) : false;
        $pass = isset($_POST["password"]) ? $_POST["password"] : false;

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            if (password_verify($pass, $usuario["password"])) {
                $address = new Address($usuario["apartmentNumber"], $usuario["street"], $usuario["city"], $usuario["region"],
                $usuario["country"], $usuario["postalCode"]);
                $user = new User($usuario["id"], $usuario["username"], $usuario["email"], $usuario["phoneNumber"],
                $usuario["password"], $address, $usuario["createDate"]);
                $_SESSION["usuario"] = $user;
                $_SESSION["completado"] = "Login completado";
                header("Location: ../view/home.php");
                session_start();
                exit;
            } else {
                $_SESSION["errores"] = "Contraseña incorrecta";
                header("Location: ../view/login.php");
                exit;
            }
        } else {
            $_SESSION["errores"] = "No está registrado este email, por favor, regístrese";
            header("Location: ../view/login.php");
            exit;
        }
    } else {
        header("Location: ../view/login.php");
    }

$pdo = null;

?>