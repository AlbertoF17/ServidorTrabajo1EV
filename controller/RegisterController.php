<?php 
    require_once("../connection/connection.php");
    if (isset($_POST["submit"])) {
        $username = isset($_POST["username"]) ? trim($_POST["username"]) : false;
        $mail = isset($_POST["email"]) ? trim($_POST["email"]) : false;
        $phoneNum = isset($_POST["phoneNumber"]) ? trim($_POST["phoneNumber"]) : false;
        $pass = isset($_POST["password"]) ? $_POST["password"] : false;
        $apartmentNum = isset($_POST["apartmentNumber"]) ? $_POST["apartmentNumber"] : false;
        $street = isset($_POST["street"]) ? $_POST["street"] : false;
        $city = isset($_POST["city"]) ? $_POST["city"] : false;
        $region = isset($_POST["region"]) ? $_POST["region"] : false;
        $country = isset($_POST["country"]) ? $_POST["country"] : false;
        $postalCode = isset($_POST["postalCode"]) ? $_POST["postalCode"] : false;
        

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
            $stmt = $pdo->prepare("INSERT INTO users (id, roleId, username, email, phoneNumber, password, apartmentNumber, street, city, region, country, postalCode, createDate) VALUES
            (0, 1, :username, :mail, :phoneNum, :pass, :apartmentNum, :street, :city, :region, :country, :postalCode, CURDATE())");
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':mail', $mail);
            $stmt->bindParam(':phoneNum', $phoneNum);
            $stmt->bindParam(':pass', $passSegura);
            $stmt->bindParam(':apartmentNum', $apartmentNum);
            $stmt->bindParam(':street', $street);
            $stmt->bindParam(':city', $city);
            $stmt->bindParam(':region', $region);
            $stmt->bindParam(':country', $country);
            $stmt->bindParam(':postalCode', $postalCode);
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

$pdo = null;

?>