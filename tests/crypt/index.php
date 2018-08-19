<?php
$pwd = '';
if (isset($_POST["pwd"]))
{
    $pwd = htmlspecialchars($_POST["pwd"]);
    $pwd = crypt($pwd, '');
}
?>
<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Crypto</title>
</head>
<body>
    <h1>Obtenez votre mdp crypté par PHP</h1>

    <form method="post" action="index.php">
        <label for="pwd">Mdp</label>: <input type="password" id="pwd" name="pwd"> <br>
        <input type="submit" id="submit" name="submit" value="crypter">
    </form>
    <p>
        <?php if ($pwd != "")
        {
            echo 'Voici votre mdp crypté: '.$pwd;    
        }
        ?>
    </p>
</body>
</html>