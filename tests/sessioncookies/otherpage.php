<?php
//starting session before any html code
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Session et cookies</title>
    </head>
    <body>
        <h1>Session et cookies part 2</h1>
        <p>
            J'ai bien retenu les var de session!
            <?php
                echo '<br>';
                print_r($_SESSION);
            ?>
            <br>
            <a href="index.php">Accueil du site</a>
            <br>
            <a href="anotherpage.php">Une autre page du site</a>
        </p>
        <footer>
            <?php include("deco.php"); ?>
        </footer>
    </body>
</html>