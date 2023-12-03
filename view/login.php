<?php
require_once("../connection/connection.php");
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
    <title>HardwareHub</title>
</head>
<body>
    <header>
        <div class="menu-icon">
            <span></span>
        </div>
        <ul class="sidenav retract">
            <li><a href="../view/home.php">Home</a></li>
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
        <div>
            <a href="../view/home.php" class="btn btn-primary corner-btn">Return to main page</a>
        </div>
    </header>
    <main class="retract">
        <?= $SESSION["errores"] ?>
        <ul class="nav nav-pills mb-3 d-flex justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="pills-login-tab" data-bs-toggle="pill" data-bs-target="#pills-login" type="button" role="tab" aria-controls="pills-login" aria-selected="true">Log In</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="pills-signin-tab" data-bs-toggle="pill" data-bs-target="#pills-signin" type="button" role="tab" aria-controls="pills-signin" aria-selected="false">Sign In</button>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="pills-login-tab" tabindex="0">
                <form action="../controller/LoginController.php" method="POST" class="container w-75">
                    <div class="form-outline mb-4">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" class="form-control" name="email"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" id="username" class="form-control" name="username"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" id="password" class="form-control" name="password"/>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mb-4 px-5" name="submit">Log in</button>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-signin" role="tabpanel" aria-labelledby="pills-signin-tab" tabindex="0">
                <form action="../controller/RegisterController.php" method="POST" class="container w-75">
                    <div class="form-outline mb-4">
                    <label class="form-label" for="username">Username</label>
                        <input type="text" id="username" class="form-control" name="username"/>
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" class="form-control" name="email"/>
                    </div>
                    <div class="form-outline mb-4">
                        <div class="row g-3">
                            <div class="col">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" class="form-control" name="password"/>
                            </div>
                            <div class="col">
                                <label class="form-label" for="repeatPassword">Repeat password</label>
                                <input type="password" id="repeatPassword" class="form-control" name="repeatPassword"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-outline mb-4">
                        <label class="form-label" for="phoneNumber">Phone Number</label>
                        <input type="tel" id="phoneNumber" class="form-control" name="phoneNumber"/>
                    </div>
                    <div class="form-outline mb-4">
                        <div class="row g-3">
                            <div class="col">
                                <label class="form-label" for="street">Street</label>
                                <input type="text" id="street" class="form-control" name="street"/>
                            </div>
                            <div class="col">
                                <label class="form-label" for="streetNumber">Street Number</label>
                                <input type="text" id="streetNumber" class="form-control" name="streetNumber">
                            </div>
                        </div>
                    </div>
                    <div class="form-outline mb-4">
                        <div class="row g-3">
                            <div class="col">
                                <label class="form-label" for="city">City</label>
                                <input type="text" id="city" class="form-control" name="city"/>
                            </div>
                            <div class="col">
                                <label class="form-label" for="region">Region</label>
                                <input type="text" id="region" class="form-control" name="region"/>
                            </div>
                            <div class="col">
                                <label class="form-label" for="country">Country</label>
                                <input type="text" id="country" class="form-control" name="country"/>
                            </div>
                            <div class="col">
                                <label class="form-label" for="postalCode">Postal Code</label>
                                <input type="text" id="postalCode" class="form-control" name="postalCode"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-check d-flex justify-content-center mb-4">
                        <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck"
                        aria-describedby="registerCheckHelpText" />
                        <label class="form-check-label" for="registerCheck">I have read and agree to the terms</label>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mb-3 px-5" name="submit">Sign in</button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>