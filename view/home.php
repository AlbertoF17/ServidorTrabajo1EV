<?php
require_once(__DIR__."/../connection/connection.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Address.php");
session_start();

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
    <title>HardwareHub</title>
</head>
<body>
    <header>
        <div class="menu-icon">
            <span></span>
        </div>
        <ul class="sidenav retract">
            <li><a href="#">Home</a></li>
            <button class="dropdown-btn">Products 
                <img class="bx" src="../view/media/arrow-down-icon.png"/>
            </button>
            <ul class="dropdown-container">
                <li><a href="../view/products.php">All Products</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a href="#">Components</a></li>
                <li><a href="#">Peripherals</a></li>
                <li><a href="#">Keys</a></li>
            </ul>
            <button class="dropdown-btn">Services 
                <img class="bx" src="../view/media/arrow-down-icon.png"/>
            </button>
            <ul class="dropdown-container">
                <li><a href="../view/services.php">All Services</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a href="#">Design a website</a></li>
                <li><a href="#">Check and upgrade PC's performance</a></li>
                <li><a href="#">Install drivers and programs</a></li>
                <li><a href="#">PC repair</a></li>
                <li><a href="#">Bug fixes</a></li>
                <li><a href="#">Website maintenance</a></li>
            </ul>
            <li><a href="#aboutUs">About Us</a></li>
        </ul>
        <?php if(isset($_SESSION["usuario"])) : ?>
            <div class="dropdown d-flex justify-content-end">
                <button class="btn btn-light dropdown-toggle corner-dropdown" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../media/user.png" alt="User image"/>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="../controller/ProfileController.php">Go to profile</a></li>
                    <li><a class="dropdown-item" href="../controller/LogoutController.php">Logout</a></li>
                </ul>
            </div>
        <?php else : ?>
            <a href="../view/login.php" class="btn btn-primary corner-btn">Log In / Sign In</a>
        <?php endif;?>
    </header>
    <main class="retract">
        <div class="shopName">
            <h1>HardwareHub</h1>
        </div>
        <div id="carouselExampleCaptions" class="carousel slide w-100">
            <h2>Recommeded Prodcuts</h2>
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                <img src="../view/media/arrow-down-icon.png" class="d-block" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>First slide label</h5>
                    <p>Some representative placeholder content for the first slide.</p>
                </div>
                </div>
                <div class="carousel-item">
                <img src="../view/media/arrow-down-icon.png" class="d-block" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Second slide label</h5>
                    <p>Some representative placeholder content for the second slide.</p>
                </div>
                </div>
                <div class="carousel-item">
                <img src="../view/media/arrow-down-icon.png" class="d-block" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Third slide label</h5>
                    <p>Some representative placeholder content for the third slide.</p>
                </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <div>
            <p>AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA</p>
        </div>
    </main>
</body>
</html>