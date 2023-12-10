<?php
require_once("../connection/connection.php");
require_once("../controller/ProductsController.php");
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
            <li><a href="../view/home.php">Home</a></li>
            <li><a href="../view/products.php">Products</a></li>
            <li><a href="../view/services.php">Services</a></li>
            <li><a href="../view/aboutUs.php">About Us</a></li>
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
        <h1>New Product</h1>
        <form action='../controller/ProductsController.php' method='post' enctype='multipart/form-data' class="m-4">
            <div class="mb-3 d-flex flex-column align-items-center">
                <label for="categoryID" class="form-label">Category ID:</label>
                <input type="number" class="form-control w-50 ms-25" id="categoryID" name="categoryID" required>
            </div>
            <div class="mb-3 d-flex flex-column align-items-center">
                <label for="name" class="form-label">Name:</label>
                <input type="text" class="form-control w-50 ms-25" id="name" name="name" required>
            </div>
            <div class="mb-3 d-flex flex-column align-items-center">
                <label for="price" class="form-label">Price:</label>
                <input type="number" class="form-control w-50 ms-25" id="price" name="price" step="0.01" required>
            </div>
            <div class="mb-3 d-flex flex-column align-items-center">
                <label for="description" class="form-label">Description:</label>
                <input type="text" class="form-control w-50 ms-25" id="description" name="description" required>
            </div>
            <div class="mb-3 d-flex flex-column align-items-center">
                <label for="image" class="form-label">Upload Image:</label>
                <input type="file" class="form-control w-50 ms-25" id="image" name="image" required>
            </div>
            <button type="submit" class="btn btn-primary px-5">Submit</button>
        </form>
    </main>
</body>
</html>