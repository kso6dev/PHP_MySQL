<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Password checking</title>
    </head>
    <body>
        <?php
        if (!isset($_POST["pwd"]))
        {
        ?>
            <form method="POST" action="target.php" >
                <p>
                    Veuillez saisir le mot de passe pour accéder à la 2è page:
                    <br>
                    <input type="password" name="password" id="password">
                    <br>
                    <input type="submit" name="access" value="access">
                </p>    
            </form>
            <br>
            <form method="POST" action="index.php">
                <p>
                    A moins que vous souhaitiez accéder au contenu caché de cette page, dans ce cas saisissez le 2è mot de passe:
                    <br>
                    <input type="password" name="pwd" id="pwd">
                    <br>
                    <input type="submit" name="submit" value="submit">
                </p>
            </form>
        <?php
        }
        else if ($_POST["pwd"] == "kangoo")
        {
        ?>
            <h1>Contenu secret</h1>
            <p>
                voici un contenu sécurisé grâce à un mdp envoyé à cette page web mais qui ne contenait pas ce contenu avant de le recevoir!
            </p>
        <?php
        }
        else
        {
            echo 'mauvais mot de passe, dégage!';
        }
        ?>
    </body>
</html>