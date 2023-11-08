<?php
require_once(__DIR__."/../connection/connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../view/css/styles.css">
    <script src="../view/js/app.js" defer></script>
    <title>Document</title>
</head>
<body>
    <header>
        <div class="menu-icon">
            <span></span>
        </div>
        <ul class="sidenav retract">
            <button class="dropdown-btn">Productos 
                <img class="bx" src="../view/media/arrow-down-icon.png"/>
            </button>
            <ul class="dropdown-container">
                <li><a href="../view/products.php">Todos los productos</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a href="#">Componentes</a></li>
                <li><a href="#">Periféricos</a></li>
                <li><a href="#">Teclas</a></li>
            </ul>
            <button class="dropdown-btn">Servicios 
                <img class="bx" src="../view/media/arrow-down-icon.png"/>
            </button>
            <ul class="dropdown-container">
                <li><a href="#">Todos los servicios</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a href="#">Diseñar una web</a></li>
                <li><a href="#">Comprobar y mejorar tu rendimiento</a></li>
                <li><a href="#">Instalar drivers y programas</a></li>
                <li><a href="#">Reparación de pc</a></li>
                <li><a href="#">Solución de errores</a></li>
                <li><a href="#">Mantenimiento de tu web</a></li>
            </ul>
            <li><a href="#aboutUs">About Us</a></li>
        </ul>
    </header>
    <main class="retract">
        <div class="shopName">
            <h1>Nombre de la empresa</h1>
        </div>
        <div>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Todos los servicios</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Diseñar una web</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Comprobar y mejorar tu rendimiento</button>
                    <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-disabled" type="button" role="tab" aria-controls="nav-disabled" aria-selected="false">Instalar drivers y programas</button>
                    <button class="nav-link" id="nav-hola-tab" data-bs-toggle="tab" data-bs-target="#nav-hola" type="button" role="tab" aria-controls="nav-hola" aria-selected="false">Reparación de pc</button>
                    <button class="nav-link" id="nav-adios-tab" data-bs-toggle="tab" data-bs-target="#nav-adios" type="button" role="tab" aria-controls="nav-adios" aria-selected="false">Solución de errores</button>
                    <button class="nav-link" id="nav-jaja-tab" data-bs-toggle="tab" data-bs-target="#nav-jaja" type="button" role="tab" aria-controls="nav-jaja" aria-selected="false">Mantenimiento de tu web</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">todos los serv</div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">web desing</div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">rendimiento</div>
                <div class="tab-pane fade" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">drver</div>
                <div class="tab-pane fade" id="nav-hola" role="tabpanel" aria-labelledby="nav-hola-tab" tabindex="0">arregla pc</div>
                <div class="tab-pane fade" id="nav-adios" role="tabpanel" aria-labelledby="nav-adios-tab" tabindex="0">soluciona errores</div>
                <div class="tab-pane fade" id="nav-jaja" role="tabpanel" aria-labelledby="nav-jaja-tab" tabindex="0">manten web</div>
            </div>
        </div>
    </main>
</body>
</html>