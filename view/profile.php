<?php
require_once("../connection/connection.php");
require_once("../model/User.php");
require_once("../controller/UserController.php");
require_once("../model/UserIMP.php");
require_once("../model/Cart.php");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../view/css/styles.css">
    <title>Perfil</title>
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
        <div class="shopName">
                <h1>HardwareHub</h1>
        </div>
        <div>
            <h2><?php echo $userObject->__get("userName"); ?>'s Profile</h2>
            <p>Email: <?php echo $userObject->__get("email"); ?></p>
            <p>User since: <?php echo $userObject->__get("createDate"); ?></p>
        </div>
        <a href="../view/home.php">Return to Main Page</a>
        <div class="cartList">
            <?php foreach ($userCarts as $cart) : ?>
                <div class="cartData">
                    <div class="cartId">
                        <p class="cartDate">Cart ID: <?= $cart->id ?></p>
                        <p><?= $cart->date ?></p>
                    </div>
                    <?php foreach ($cart->products as $item) : ?>
                        <div class="cartItem">
                            <?php
                            if (isset($item['image'])) {
                                $imageData = base64_encode($item['image']);
                                $src = "data:image/jpeg;base64," . $imageData;
                            } else {
                                // Lógica para manejar si la imagen es nula
                                $src = ''; // O proporciona una imagen de reemplazo predeterminada
                            }
                            ?>
                            <img src="<?= $src ?>" alt="<?= $item['name'] ?>">
                            <p><?= $item['name'] ?></p>
                            <p><?= $item['price'] ?> €</p>
                        </div>
                    <?php endforeach; ?>
                </div>  
            <?php endforeach; ?>
        </div>
    </main>
</body>

</html>