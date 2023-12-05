<?php
require_once(__DIR__."/../connection/connection.php");
require_once(__DIR__."/../controller/ServicesController.php");
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
                <li><a href="#">All Services</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a href="#">Design a website</a></li>
                <li><a href="#">Check and upgrade PC's performance</a></li>
                <li><a href="#">Install drivers and programs</a></li>
                <li><a href="#">PC repair</a></li>
                <li><a href="#">Bug fixes</a></li>
                <li><a href="#">Website maintenance</a></li>
            </ul>
            <li><a href="../view/aboutUs.php">About Us</a></li>
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
        <div class="shopName">
            <h1>HardwareHub</h1>
        </div>
        <div>
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">All Services</button>
                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Design a website</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Check and upgrade PC's performanceo</button>
                    <button class="nav-link" id="nav-disabled-tab" data-bs-toggle="tab" data-bs-target="#nav-disabled" type="button" role="tab" aria-controls="nav-disabled" aria-selected="false">Install drivers and programs</button>
                    <button class="nav-link" id="nav-hola-tab" data-bs-toggle="tab" data-bs-target="#nav-hola" type="button" role="tab" aria-controls="nav-hola" aria-selected="false">PC repair</button>
                    <button class="nav-link" id="nav-adios-tab" data-bs-toggle="tab" data-bs-target="#nav-adios" type="button" role="tab" aria-controls="nav-adios" aria-selected="false">Bug fixes</button>
                    <button class="nav-link" id="nav-jaja-tab" data-bs-toggle="tab" data-bs-target="#nav-jaja" type="button" role="tab" aria-controls="nav-jaja" aria-selected="false">Website maintenance</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane show active p-4 d-flex flex-wrap gap-4" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab" tabindex="0">
                    <?php foreach ($allServices as $service):?>
                        <div class="container d-flex flex-column align-items-center justify-content-between pb-3 border rounded w-25">
                            <?php
                                $imageData = base64_encode($service->image);
                            ?>
                            <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Service Image" class="w-50">
                            <p class="m-0 fs-3"><?php echo $service->name; ?></p>
                            <p class="m-0 fs-6"><?php echo $service->description; ?></p>
                            <p class="m-0"><?php echo $service->price."€"; ?></p>
                            <?php if(isset($_SESSION["usuario"])): ?>
                                <form action="../controller/CartController.php" method="get">
                                    <input type="hidden" name="add_to_cart" value="<?php echo $service->id; ?>">
                                    <button type="submit" class="btn-primary addToCart-btn">Add to cart</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php endforeach;?>
                </div>
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab" tabindex="0">
                <?php foreach ($webDesign as $service):?>
                    <div class="container d-flex flex-column align-items-center justify-content-between pb-3 border rounded w-25">
                        <?php
                            $imageData = base64_encode($service->image);
                        ?>
                        <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Service Image" class="w-50">
                        <p class="m-0 fs-3"><?php echo $service->name; ?></p>
                        <p class="m-0 fs-6"><?php echo $service->description; ?></p>
                        <p class="m-0"><?php echo $service->price."€"; ?></p>
                        <?php if(isset($_SESSION["usuario"])): ?>
                            <form action="../controller/CartController.php" method="get">
                                <input type="hidden" name="add_to_cart" value="<?php echo $service->id; ?>">
                                <button type="submit" class="btn-primary addToCart-btn">Add to cart</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                </div>
                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab" tabindex="0">
                <?php foreach ($upgradePreformance as $service):?>
                    <div class="container d-flex flex-column align-items-center justify-content-between pb-3 border rounded w-25">
                        <?php
                            $imageData = base64_encode($service->image);
                        ?>
                        <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Service Image" class="w-50">
                        <p class="m-0 fs-3"><?php echo $service->name; ?></p>
                        <p class="m-0 fs-6"><?php echo $service->description; ?></p>
                        <p class="m-0"><?php echo $service->price."€"; ?></p>
                        <?php if(isset($_SESSION["usuario"])): ?>
                            <form action="../controller/CartController.php" method="get">
                                <input type="hidden" name="add_to_cart" value="<?php echo $service->id; ?>">
                                <button type="submit" class="btn-primary addToCart-btn">Add to cart</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                </div>
                <div class="tab-pane fade" id="nav-disabled" role="tabpanel" aria-labelledby="nav-disabled-tab" tabindex="0">
                <?php foreach ($drivers as $service):?>
                    <div class="container d-flex flex-column align-items-center justify-content-between pb-3 border rounded w-25">
                        <?php
                            $imageData = base64_encode($service->image);
                        ?>
                        <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Service Image" class="w-50">
                        <p class="m-0 fs-3"><?php echo $service->name; ?></p>
                        <p class="m-0 fs-6"><?php echo $service->description; ?></p>
                        <p class="m-0"><?php echo $service->price."€"; ?></p>
                        <?php if(isset($_SESSION["usuario"])): ?>
                            <form action="../controller/CartController.php" method="get">
                                <input type="hidden" name="add_to_cart" value="<?php echo $service->id; ?>">
                                <button type="submit" class="btn-primary addToCart-btn">Add to cart</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                </div>
                <div class="tab-pane fade" id="nav-hola" role="tabpanel" aria-labelledby="nav-hola-tab" tabindex="0">
                <?php foreach ($repair as $service):?>
                    <div class="container d-flex flex-column align-items-center justify-content-between pb-3 border rounded w-25">
                        <?php
                            $imageData = base64_encode($service->image);
                        ?>
                        <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Service Image" class="w-50">
                        <p class="m-0 fs-3"><?php echo $service->name; ?></p>
                        <p class="m-0 fs-6"><?php echo $service->description; ?></p>
                        <p class="m-0"><?php echo $service->price."€"; ?></p>
                        <?php if(isset($_SESSION["usuario"])): ?>
                            <form action="../controller/CartController.php" method="get">
                                <input type="hidden" name="add_to_cart" value="<?php echo $service->id; ?>">
                                <button type="submit" class="btn-primary addToCart-btn">Add to cart</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                </div>
                <div class="tab-pane fade" id="nav-adios" role="tabpanel" aria-labelledby="nav-adios-tab" tabindex="0">
                <?php foreach ($bugFix as $service):?>
                    <div class="container d-flex flex-column align-items-center justify-content-between pb-3 border rounded w-25">
                        <?php
                            $imageData = base64_encode($service->image);
                        ?>
                        <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Service Image" class="w-50">
                        <p class="m-0 fs-3"><?php echo $service->name; ?></p>
                        <p class="m-0 fs-6"><?php echo $service->description; ?></p>
                        <p class="m-0"><?php echo $service->price."€"; ?></p>
                        <?php if(isset($_SESSION["usuario"])): ?>
                            <form action="../controller/CartController.php" method="get">
                                <input type="hidden" name="add_to_cart" value="<?php echo $service->id; ?>">
                                <button type="submit" class="btn-primary addToCart-btn">Add to cart</button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
                </div>
                <div class="tab-pane fade" id="nav-jaja" role="tabpanel" aria-labelledby="nav-jaja-tab" tabindex="0">
                    <?php foreach ($webManteinance as $service):?>
                        <div class="container d-flex flex-column align-items-center justify-content-between pb-3 border rounded w-25">
                            <?php
                                $imageData = base64_encode($service->image);
                            ?>
                            <img src="data:image/jpeg;base64,<?php echo $imageData; ?>" alt="Service Image" class="w-50">
                            <p class="m-0 fs-3"><?php echo $service->name; ?></p>
                            <p class="m-0 fs-6"><?php echo $service->description; ?></p>
                            <p class="m-0"><?php echo $service->price."€"; ?></p>
                            <?php if(isset($_SESSION["usuario"])): ?>
                                <form action="../controller/CartController.php" method="get">
                                    <input type="hidden" name="add_to_cart" value="<?php echo $service->id; ?>">
                                    <button type="submit" class="btn-primary addToCart-btn">Add to cart</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <a href="newService.php">
            <button class="add-button">+</button>
        </a>
    </main>
</body>
</html>