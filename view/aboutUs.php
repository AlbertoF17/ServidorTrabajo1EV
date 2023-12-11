<?php
require_once(__DIR__."/../connection/connection.php");
require_once(__DIR__."/../controller/AboutUsController.php");

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
            <li><a href="../view/home.php">Home</a></li>
            <li><a href="../view/products.php">Products</a></li>
            <li><a href="../view/services.php">Services</a></li>
            <li><a href="#">About Us</a></li>
        </ul>
        <?php if(isset($_SESSION["user"])) : ?>
            <div class="dropdown d-flex justify-content-end">
                <button class="btn btn-light dropdown-toggle corner-dropdown" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="../media/user.png" alt="User image"/>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <li><a class="dropdown-item" href="../view/profile.php">Go to profile</a></li>
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
        <div>
            <p class="mx-2 px-4">
                Welcome to HardwareHub! We're a new tech company with a simple goal: to make your tech life awesome.
                We sell computer stuff online, from components to cool peripherals.
                Our team is a bunch of tech experts who are here to help you with anything tech-related, whether you're building a computer or need tech services,
                we've got your back. Our mission is to make tech easy and fun for you.</p>
        </div>
        <div class="d-flex flex-wrap justify-content-center align-items-stretch p-3 gap-4">
            <?php foreach($employees as $employee): ?>
                <div class="w-25 border rounded d-flex flex-column align-items-center justify-content-between">
                    <h3><?= $employee->__get("firstName")." ".$employee->__get("lastName") ?></h3>
                    <img src="../media/<?= $employee->__get("firstName") ?>.jpeg" class="w-50"/>
                    <p class="mt-1"><?= $employee->__get("title") ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="d-flex flex-column justify-content-center align-items-center my-4 gap-2">
            <h2>Contact Us</h2>
            <form method="post" class="w-100 d-flex flex-column justify-content-center align-items-center">
                <textarea class="form-control w-75" rows="10" name="message" placeholder="Write your message here..." required></textarea>
                <button type="submit" name="send" class="btn btn-primary mt-2 fs-5">Send</button>
            </form>
        </div>
        <div class="d-flex flex-column align-items-end px-4 pb-3">
            <p class="m-0">Calle Espinosa y Cárcel, 21</p>
            <p class="m-0">Sevilla, 41005</p>
            <p class="m-0">954 93 20 81</p>
        </div>
    </main>
</html>