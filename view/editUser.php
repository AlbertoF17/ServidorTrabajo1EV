<?php
require_once(__DIR__."/../connection/connection.php");
require_once(__DIR__."/../model/User.php");
require_once(__DIR__."/../model/Address.php");
require_once(__DIR__."/../controller/UserController.php");
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
            <li><a href="../view/skill_courses.php">Skill Courses</a></li>
            <li><a href="../view/business_services.php">Business Services</a></li>
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
        <h1>Edit Profile</h1>
        <div class="d-flex justify-content-center align-items-center">
            <form action="../controller/EditUserController.php" method="post"  class="w-50 d-flex flex-column justify-content-center align-self-center gap-4">
                <div>
                    <label for="userName" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="userName" name="userName" value="<?= $userObject->__get("userName"); ?>" required>
                </div>
                <div>
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $userObject->__get("email"); ?>" required>
                </div>
                <div>
                    <label for="phoneNumber" class="form-label">Phone Number:</label>
                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" value="<?php echo $userObject->__get("phoneNumber"); ?>" required>
                </div>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </form>
        </div>
    </main>
</body>
</html>