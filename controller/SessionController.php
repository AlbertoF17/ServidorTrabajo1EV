<?php
    require_once "../connection/connection.php";
    require_once "../model/User.php";
    session_start();

    if (isset($_POST["loginSubmit"])) {
        logInUser($pdo);
    } elseif (isset($_POST["signinSubmit"])) {
        signInUser($pdo);
    }

    function signInUser($pdo){
        if (isset($_POST["submit"])) {
            $username = isset($_POST["username"]) ? trim($_POST["username"]) : false;
            $mail = isset($_POST["email"]) ? trim($_POST["email"]) : false;
            $pass = isset($_POST["password"]) ? $_POST["password"] : false;
    
            $arrayErrores = array();
            if (!empty($username) && !is_numeric($username) && strlen($username) > 2) {
                $usernameValidado = true;
            } else if (empty($username)) {
                $usernameValidado = false;
                $arrayErrores["username"] = "El username esta vacio";
            } else if (strlen($username) <= 2) {
                $usernameValidado = false;
                $arrayErrores["username"] = "El username es muy corto";
            } else {
                $usernameValidado = false;
                $arrayErrores["username"] = "El username no debe ser numerico";
            }
    
            if (!empty($mail) && filter_var($mail, FILTER_VALIDATE_EMAIL)) {
                $mailValidado = true;
            } else {
                $mailValidado = false;
                $arrayErrores["mail"] = "El mail no es valido";
            }
    
            if (!empty($pass) && strlen($pass) > 8) {
                $passValidado = true;
            } else {
                $passValidado = false;
                $arrayErrores["password"] = "El password no es valido";
            }
    
            if ($usernameValidado && $mailValidado && $passValidado) {
                $_SESSION["errores"] = null;
                unset($_SESSION["errores"]);
                $passSegura = password_hash($pass, PASSWORD_BCRYPT, ["cost" => 8]);
                $stmt = $pdo->prepare("INSERT INTO users (username, email, password, createDate) VALUES (:username, :mail, :pass, CURDATE())");
                $stmt->bindParam(':username', $username);
                $stmt->bindParam(':mail', $mail);
                $stmt->bindParam(':pass', $passSegura);
                $guardar = $stmt->execute();
                if ($guardar) {
                    $_SESSION["completado"] = "Registro completado";
                } else {
                    $_SESSION["errores"]["general"] = "Fallo en el registro";
                }
            } else {
                $_SESSION["errores"] = $arrayErrores;
            }
            header("Location: ../view/login.php");
        }
    }


    function logInUser($pdo){
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
                    $user = new User($usuario["id"], $usuario["username"], $usuario["email"], $usuario["phoneNumber"], $usuario["password"], $usuario["address"], $usuario["createDate"]);
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
    }

$pdo = null;

?>