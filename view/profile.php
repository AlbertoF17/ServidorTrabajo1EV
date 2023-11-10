<?php
require_once("../connection/connection.php");
require_once("../model/User.php");
require_once("../controller/UserController.php");
require_once("../controller/TweetsController.php");
require_once("../model/UsersIMP.php");
session_start();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Perfil</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="CSS/styles.css" rel="stylesheet">
</head>

<body>
    <h1>Perfil de <?php echo $userObject->__get("userName"); ?></h1>
    <p>Seguidores: <?php echo $followers.$tabulacion ?> Seguidos: <?php echo $following; ?></p>
    <p>Correo electrónico: <?php echo $userObject->__get("email"); ?></p>
    <p>Usuario desde: <?php echo $userObject->__get("createDate"); ?></p>
    <?php if ($isLogged): ?>
        <p>Descripción: <?php echo $userObject->__get("description"); ?></p>
        <a href="description.php">Editar descripción</a>
    <?php endif; ?>
        
    <?php if (!$isLogged): ?> 
        <?php if ($followButtons): ?> 
           <a href="../controller/UnfollowController.php?id=<?php echo $userObject->__get("id"); ?>">Dejar de seguir</a>
        <?php else : ?>
            <a href="../controller/FollowController.php?id=<?php echo $userObject->__get("id"); ?>">Seguir</a>
        <?php endif; ?>
    <?php endif; ?>
    <?php echo $tabulacion; ?>
    <a href="home.php">Volver a la página principal</a>
    <div class="nuevo">
        <h2>Nuevo Tweet</h2>
            <form action="../controller/TweetsController.php" method="POST">
                <textarea name="tweet" class="textareaPerfil"></textarea>
                <p><input type="submit" value="Publicar" class="btn btn-primary"></p>
            </form>
    </div>
    <?php if (count($userTweets) === 0): ?>
        <?php if ($isLogged): ?> 
            <p>¡¡¡Es el momento de publicar tu primer tuit!!!</p>
        <?php else : ?>
            <p>El usuario no ha publicado ningún tuit por el momento.</p>
        <?php endif; ?>
    <?php else: ?>
    <h2>Tweets</h2>
        <ul class="tuitPerfil">
            <?php foreach ($userTweets as $tweet): ?>
                <li class="perfil">
                    <div>
                        <b><a href="profile.php?id=<?php echo $tweet->user->id; ?>">
                            <?php echo $tweet->user->userName;?></a></b><b class="doubleDots">:</b>
                        <?php echo $tweet->text; ?>
                    </div>
                    <div>
                        <p class="fecha"><?php echo $tweet->createDate; ?></p>
                        <?php if ($tweet->user->id === $_SESSION["usuario"]->id): ?>
                            <form action="../controller/TweetsController.php" method="POST" class="botonEliminar">
                                <input type="hidden" name="tweet_id" value="<?php echo $tweet->id; ?>">
                                <input type="submit" value="Eliminar" class="btn btn-danger">
                            </form>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

</body>

</html>