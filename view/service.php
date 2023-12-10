<?php
require_once(__DIR__."/../connection/connection.php");
require_once(__DIR__."/../controller/ServiceController.php");
require_once(__DIR__."/../model/Service.php");
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
        <?php if (isset($_SESSION["user"])) : ?>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="cartDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Cart
                </button>
                <ul class="dropdown-menu cartList" aria-labelledby="cartDropdown">
                    <?php if (isset($_COOKIE["cart"]) && count(json_decode($_COOKIE["cart"])) > 0) : ?>
                        <?php
                        // Decodificar la cookie JSON
                        $cartItems = json_decode($_COOKIE["cart"]);
                        foreach ($cartItems as $item) :
                            ?>
                                <li>
                                    <?= $item->quantity; ?> x <?= $item->name; ?> - <?= $item->price; ?>€
                                    <form action="../controller/CartController.php" method="get">
                                        <input type="hidden" name="remove_from_cart" value="<?php echo $item->id;?>">
                                        <button type="submit" class="btn btn-outline-primary removeFromCart-btn">Remove from cart</button>
                                    </form>
                                </li>
                            <?php endforeach; ?>
                            
                        <li class="dropdown-divider"></li>
                        <li>
                            <form action="../controller/CartController.php" method="get">
                                <input type="hidden" name="clear_cart" value="true">
                                <button type="submit" class="btn btn-outline-danger clearCart-btn">Clear Cart</button>
                            </form>
                            <form action="../controller/CartController.php" method="get">
                                <input type="hidden" name="confirm_purchase" value="true">
                                <button type="submit" class="btn btn-outline-success confirmPurchase-btn">Confirm Purchase</button>
                            </form>
                        </li>
                    <?php else : ?>
                        <li class="px-3">Cart is empty</li>
                    <?php endif; ?>
                </ul>
            </div>
        <?php endif; ?>
        <div class="shopName">
            <h1>HardwareHub</h1>
        </div>
        <div>
            <div class="">
                <?php
                $serviceId = $_GET['service_id'];

                $serviceName = $specificService->name;
                $serviceDescription = $specificService->description;
                $servicePrice = $specificService->price;
                $serviceImg = base64_encode($specificService->image);
                $serviceImage = "data:image/jpeg;base64,$serviceImg"; ?>
                <img src="<?= $serviceImage ?>" alt="Service Image" class="w-50">
                <h2 class="mt-3"><?= $serviceName ?></h2>
                <p><?= $serviceDescription ?></p>
                <p class="fw-bold"><?= $servicePrice ?> €</p>
                <div>
                    <button class="btn btn-outline-primary">Edit Service</button>
                    <button class="btn btn-outline-danger">Delete Service</button>
                </div>
            </div>
        </div>
    </main>
</body>
</html>