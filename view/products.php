<?php
session_start();
require_once("../connection/connection.php");
require_once("../controller/ProductsController.php");
//require_once("../controller/CartController.php");
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
        <li><a href="../view/home.php">Home</a></li>
        <li>
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
        </li>
        <li>
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
        </li>
        <li><a href="#aboutUs">About Us</a></li>
    </ul>
    <?php if(isset($_SESSION["usuario"])) : ?>
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
    <?php if (isset($_SESSION["usuario"])) : ?>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="cartDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                Cart
            </button>
            <ul class="dropdown-menu" aria-labelledby="cartDropdown">
                <?php if (isset($_COOKIE["my_cart"]) && !empty($_COOKIE["my_cart"])) : ?>
                    <?php
                    // Decodificar la cookie JSON
                    $cartItems = json_decode($_COOKIE["my_cart"]);

                    foreach ($cartItems as $item) :
                        ?>
                            <li>
                                <?= $item->quantity; ?> x <?= $item->name; ?> - <?= $item->price; ?>€
                            </li>
                        <?php endforeach; ?>
                        
                    <li class="dropdown-divider"></li>
                    <li>
                        <form action="../controller/CartController.php" method="get">
                            <input type="hidden" name="clear_cart" value="true">
                            <button type="submit" class="btn btn-outline-danger clearCart-btn">Clear Cart</button>
                        </form>
                    </li>
                <?php else : ?>
                    <li class="px-3">Cart is empty</li>
                <?php endif; ?>
            </ul>
        </div>
    <?php endif; ?>
    <div class="shopName">
        <?= var_dump($_COOKIE["my_cart"]); ?>
        <h1>HardwareHub</h1>
    </div>
    <div>
        <div>
            <?php if (isset($_SESSION["usuario"])) : ?>
                <form action="../controller/CartController.php" method="get">
                    <input type="hidden" name="remove_from_cart" value="<?php echo $product->id; ?>">
                    <button type="submit" class="btn-primary removeFromCart-btn">Remove from cart</button>
                </form>
            <?php endif; ?>
            <?php if (isset($_SESSION["usuario"])) : ?>
                <form action="../controller/CartController.php" method="get">
                    <input type="hidden" name="confirm_purchase" value="true">
                    <button type="submit" class="btn-primary confirmPurchase-btn">Confirm Purchase</button>
                </form>
            <?php endif; ?>
        </div>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">All products</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Components</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Peripherals</button>
                <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-disabled" type="button" role="tab" aria-controls="nav-disabled" aria-selected="false">Keys</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active p-4" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
            <ul class="list-unstyled list-group list-group-horizontal d-flex flex-wrap">
            <?php if(!empty($allProducts)){
                foreach ($allProducts as $product):?>
                <li class="product list-item w-25">
                    <div class="container d-flex flex-column align-items-center pb-3 border rounded">
                        <?php
                            $imageData = base64_encode($product->image);
                        ?>
                        <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Product Image" class="w-50">
                        <p class="m-0 fs-3"><?php echo $product->name; ?></p>
                        <p class="m-0 fs-6"><?php echo $product->description; ?></p>
                        <p class="m-0"><?php echo $product->price."€"; ?></p>
                        <?php if(isset($_SESSION["usuario"])): ?>
                            <form action="../controller/CartController.php" method="get">
                                <input type="hidden" name="add_to_cart" value="<?php echo $product->id; ?>">
                                <button type="submit" class="btn-primary addToCart-btn">Add to cart</button>
                            </form>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; 
            } ?>
            </ul>
            </div>
            <div class="tab-pane fade p-4" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                <ul class="list-unstyled list-inline">
                <?php if(!empty($components)){
                    foreach ($components as $product):?>
                    <li class="product">
                        <div class="container w-50 d-flex flex-column justify-content-center align-items-center">
                            <?php
                                $imageData = base64_encode($product->image);
                            ?>
                            <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Product Image" class="w-50">
                            <p><?php echo $product->name; ?></p>
                            <p><?php echo $product->price."€"; ?></p>
                        </div>
                    </li>
                <?php endforeach; 
                } ?>
            </ul>
            </div>
            <div class="tab-pane fade p-4" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                <ul class="list-unstyled">
                <?php if(!empty($peripherals)){
                    foreach ($peripherals as $product):?>
                    <li class="product">
                        <div class="container w-50 d-flex flex-column justify-content-center align-items-center">
                            <?php
                                $imageData = base64_encode($product->image);
                            ?>
                            <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Product Image" class="w-50">
                            <p><?php echo $product->name; ?></p>
                            <p><?php echo $product->price."€"; ?></p>
                        </div>
                    </li>
                <?php endforeach; 
                } ?>
                </ul>
            </div>
            <div class="tab-pane fade p-4" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">
                <ul class="list-unstyled">
                <?php if(!empty($keys)){
                    foreach ($keys as $product):?>
                    <li class="product">
                        <div class="container w-50 d-flex flex-column justify-content-center align-items-center">
                            <?php
                                $imageData = base64_encode($product->image);
                            ?>
                            <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Product Image" class="w-50">
                            <p><?php echo $product->name; ?></p>
                            <p><?php echo $product->price."€"; ?></p>
                        </div>
                    </li>
                <?php endforeach; 
                } ?>
                </ul>
            </div>
        </div>
    </div>
    <a href="newProduct.php">
        <button class="add-button">+</button>
    </a>
</main>
</body>
</html>