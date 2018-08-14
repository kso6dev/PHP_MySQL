<?php
setcookie('pseudo', 'ben', time() + 31*24*3600, null, null, false, true);
setcookie('age', '31', time() + 31*24*3600, null, null, false, true);
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Session et cookies</title>
    </head>
    <body>
        <h1>Cookies</h1>
        <p>
            Cette page vient d'ajouter 2 cookies : pseudo = ben et age = 31, pour une durée de 31 jours, protégés par httpOnly.
            <br>
            <a href="otherpage.php">Autre page du site</a>
            <br>
            <a href="anotherpage.php">Une autre page du site</a>
        </p>
        <footer>
            <?php include("deco.php"); ?>
        </footer>
    </body>
</html>