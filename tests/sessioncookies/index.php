<?php
//starting session before any html code
session_start();

//check if deconnexion then destroy session vars
if (isset($_POST["deco"]) AND ($_POST["deco"] == "go"))
{
    session_destroy();
}
else
{
    //creating some session vars
    $_SESSION["name"] = 'ben';
    $_SESSION["age"] = 31;
    $_SESSION["gender"] = "male";
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Session et cookies</title>
    </head>
    <body>
        <h1>Session et cookies</h1>
        <p>
            <?php
                print_r($_COOKIE);
                echo '<br>';
                print_r($_SESSION);
            ?>
            <br>
            <a href="otherpage.php">Autre page du site</a>
            <br>
            <a href="anotherpage.php">Une autre page du site</a>
            <br>
            <a href="cookie.php">Une page qui créé des cookies</a>
            <br>
            Et si vous avez visité la page des cookies, vous avez les cookies suivants sur  votre pc:
            <br>
            <?php
            if (isset($_COOKIE["pseudo"]))
            {
                echo 'pseudo = '.htmlspecialchars($_COOKIE["pseudo"]).'. <br>';
                echo 'age = '.htmlspecialchars($_COOKIE["age"]).'. <br>';
            }
            ?>
        </p>
        <footer>
            <?php include("deco.php"); ?>
        </footer>
    </body>
</html>