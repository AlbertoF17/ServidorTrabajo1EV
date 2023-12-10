<?php
require_once("../connection/connection.php");
require_once("../controller/ProductsController.php");
//require_once("../controller/CartController.php");
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
            <li><a href="#">Products</a></li>
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
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">All products</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Components</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Peripherals</button>
                <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-disabled" type="button" role="tab" aria-controls="nav-disabled" aria-selected="false">Keys</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane show active p-4 d-flex flex-wrap gap-4" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0" id="productdiv">
                <?php foreach ($allProducts as $product):?>
                    <div class="container d-flex flex-column align-items-center justify-content-between pb-3 border rounded w-25">
                        <?php
                            $imageData = base64_encode($product->image);
                        ?>
                        <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Product Image" class="w-50">
                        <p class="m-0 fs-3"><?php echo $product->name; ?></p>
                        <p class="m-0 fs-6"><?php echo $product->description; ?></p>
                        <p class="m-0"><?php echo $product->price."€"; ?></p>
                        <?php if(isset($_SESSION["user"])): ?>
                            <form action="../controller/CartController.php" method="get">
                                <input type="hidden" name="add_to_cart" value="<?php echo $product->id; ?>">
                                <button type="submit" class="btn-primary addToCart-btn">Add to cart</button>
                            </form>
                        <?php endif; ?>
                        <a href="../view/product.php?product_id=<?php echo $product->id; ?>" class="btn-primary">View Product</a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="tab-pane fade p-4 d-flex flex-wrap gap-4" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
            <?php foreach ($components as $product):?>
                    <div class="container d-flex flex-column align-items-center justify-content-between pb-3 border rounded w-25">
                        <?php
                            $imageData = base64_encode($product->image);
                        ?>
                        <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Product Image" class="w-50">
                        <p class="m-0 fs-3"><?php echo $product->name; ?></p>
                        <p class="m-0 fs-6"><?php echo $product->description; ?></p>
                        <p class="m-0"><?php echo $product->price."€"; ?></p>
                        <?php if(isset($_SESSION["user"])): ?>
                            <form action="../controller/CartController.php" method="get">
                                <input type="hidden" name="add_to_cart" value="<?php echo $product->id; ?>">
                                <button type="submit" class="btn-primary addToCart-btn">Add to cart</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="tab-pane fade p-4 d-flex flex-wrap gap-4" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                <?php foreach ($peripherals as $product):?>
                    <div class="container d-flex flex-column align-items-center justify-content-between pb-3 border rounded w-25">
                        <?php
                            $imageData = base64_encode($product->image);
                        ?>
                        <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Product Image" class="w-50">
                        <p class="m-0 fs-3"><?php echo $product->name; ?></p>
                        <p class="m-0 fs-6"><?php echo $product->description; ?></p>
                        <p class="m-0"><?php echo $product->price."€"; ?></p>
                        <?php if(isset($_SESSION["user"])): ?>
                            <form action="../controller/CartController.php" method="get">
                                <input type="hidden" name="add_to_cart" value="<?php echo $product->id; ?>">
                                <button type="submit" class="btn-primary addToCart-btn">Add to cart</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="tab-pane fade p-4 d-flex flex-wrap gap-4" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">
                <?php foreach ($keys as $product):?>
                    <div class="container d-flex flex-column align-items-center justify-content-between pb-3 border rounded w-25">
                        <?php
                            $imageData = base64_encode($product->image);
                        ?>
                        <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Product Image" class="w-50">
                        <p class="m-0 fs-3"><?php echo $product->name; ?></p>
                        <p class="m-0 fs-6"><?php echo $product->description; ?></p>
                        <p class="m-0"><?php echo $product->price."€"; ?></p>
                        <?php if(isset($_SESSION["user"])): ?>
                            <form action="../controller/CartController.php" method="get">
                                <input type="hidden" name="add_to_cart" value="<?php echo $product->id; ?>">
                                <button type="submit" class="btn-primary addToCart-btn">Add to cart</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <a href="newProduct.php">
        <button class="add-button">+</button>
    </a>
</main>
</body>
</html>