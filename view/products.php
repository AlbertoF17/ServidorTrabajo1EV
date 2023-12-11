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
                    foreach ($cartItems as $item) : ?>
                        <li>
                            <?= $item->quantity; ?> x <?= $item->name; ?> - <?= $item->price; ?>€
                            <form action="../controller/CartController.php" method="get">
                                <input type="hidden" name="remove_from_cart" value="<?= $item->id; ?>">
                                <?php if (property_exists($item, 'type')) : ?>
                                    <input type="hidden" name="type" value="<?= $item->type; ?>">
                                <?php endif; ?>
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
    <div class="mb-3">
        <form method="get">
            <select id="categoryFilter" name="categoryFilter">
                <option value="all" <?php echo ($categoryFilter === 'all') ? 'selected' : ''; ?>>All Categories</option>
                <option value="components" <?php echo ($categoryFilter === 'components') ? 'selected' : ''; ?>>Components</option>
                <option value="peripherals" <?php echo ($categoryFilter === 'peripherals') ? 'selected' : ''; ?>>Peripherals</option>
                <option value="keys" <?php echo ($categoryFilter === 'keys') ? 'selected' : ''; ?>>Keys</option>
            </select>
            <select id="sortFilter" name="sortFilter">
                <option value="name" <?php echo ($sortFilter === 'name') ? 'selected' : ''; ?>>Sort by Name</option>
                <option value="price" <?php echo ($sortFilter === 'price') ? 'selected' : ''; ?>>Sort by Price</option>
            </select>
            <select id="orderFilter" name="orderFilter">
                <option value="asc" <?php echo ($orderFilter === 'asc') ? 'selected' : ''; ?>>Ascending</option>
                <option value="desc" <?php echo ($orderFilter === 'desc') ? 'selected' : ''; ?>>Descending</option>
            </select>
            <button type="submit" class="btn btn-outline-success">Apply Filter</button>
        </form>
    </div>
    <div class="d-flex flex-row flex-wrap gap-4 mb-3">
        <?php foreach ($allProducts as $product): ?>
            <?php
            $imageData = base64_encode($product->image);
            ?>
            <div class="container d-flex flex-column align-items-center justify-content-between pb-3 border rounded w-25">
                <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Product Image" class="w-50">
                <p class="m-0 fs-3"><?php echo $product->name; ?></p>
                <p class="m-0 fs-6"><?php echo $product->description; ?></p>
                <p class="m-0"><?php echo $product->price."€"; ?></p>
                <?php if(isset($_SESSION["user"])): ?>
                    <form action="../controller/CartController.php" method="get">
                        <input type="hidden" name="type" value="product">
                        <input type="hidden" name="add_to_cart" value="<?php echo $product->id; ?>">
                        <button type="submit" class="btn-primary addToCart-btn">Add to cart</button>
                    </form>
                <?php endif; ?>
                <a href="../view/product.php?product_id=<?php echo $product->id; ?>" class="btn-primary">View Product</a>
            </div>
        <?php endforeach; ?>
    </div>
    <a href="newProduct.php">
        <button class="add-button">+</button>
    </a>
</main>
</body>
</html>