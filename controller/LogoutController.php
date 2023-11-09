<?php
    session_start();
    if (isset($_SESSION["usuario"])) {
        session_unset(); // Elimina todas las variables de sesión
        session_destroy(); // Destruye la sesión
    }
    header("Location: ../index.php");
?>
