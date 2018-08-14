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
        <h1>Session et cookies part 3</h1>
        <p>
            J'ai encore et toujours bien retenu les var de session et j'en ai même ajouté une..
            <?php
            if (!isset($_SESSION["anotherpagevisited"]))
            {
                $_SESSION["anotherpagevisited"] = 1;
            }
            else
            {
                $_SESSION["anotherpagevisited"]++;
            }
                echo '<br>';
                print_r($_SESSION);
            ?>
            <br>
            <a href="index.php">Accueil du site</a>
            <br>
            <a href="otherpage.php">Autre page du site</a>
        </p>
        <footer>
            <?php include("deco.php"); ?>
        </footer>
    </body>
</html>