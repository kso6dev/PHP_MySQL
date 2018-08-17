<?php

    $nickname = '';
    $logout = false;

    if (isset($_POST['logout']))
    {
        $logout = true;
    }
    
    if (isset($_POST['nickname']))
    {
        $nickname = htmlspecialchars($_POST['nickname']);
    }
?>
<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Accueil chat</title>
</head>
<body>


    <h2>Identification</h2>
    <form method="post" action="index.php">
        Veuillez vous identifier: <br>
        <label for="register">Créer un compte</label>: <input type="radio" name="registerorlogin" id="register" value="register" checked> <br>
        <label for="login">Se connecter</label>: <input type="radio" name="registerorlogin" id="login" value="login"> <br>
        <label for="nickname">Pseudo</label>: <input type="text" name="nickname" id="nickname"> <br>
        <label for="password">Mot de passe</label>: <input type="password" name="password" id="password"> <br>
        <input type="submit" id="connection" value="connexion">
    </form>

    <form method="post" action="index.php">
        Déconnexion: <br>
        <input type="submit" id="logoutbutton" value="déconnexion">
        <input type="hidden" name="logout" id="logout" value="go">
    </form>
    
    <h2>Mini chat</h2>
    <form method="post" action="minichat_post.php">
        Bonjour <?php echo $nickname; ?>! <br>
        Vous pouvez poster votre message: <br>
        <textarea name="message" id="message" cols="50" rows="10">

        </textarea>
        <br>
        <input type="submit" id="submit" value="soumettre">
    </form>

    <?php 
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=test_ocr;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));//to get sql queries better errors
        }
        catch (Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }

        $query = $bdd->query('select * from simple_chat ORDER BY id DESC LIMIT 0, 20') or die (print_r($bdd->errorInfo()));
        while ($rec = $query->fetch())
        {
    ?>
            <p>
                Message de <?php echo $rec['nickname']; ?>: <br>
                <em> <?php echo $rec['message']; ?> </em> <br>
                <?php echo $rec['date']; ?>
            </p>
    <?php
        }
        
        $query->closeCursor();
    ?>
    <footer>
        <?php 
            include("kso_sqllib.php"); 
            $fieldsAndValues = array();
            $andFieldsAndValues = array();
            $whereFieldAndValue = array();
            /*
            array_push($fieldsAndValues,array("nickname","saucisse"));
            array_push($fieldsAndValues,array("message","test modification via ma library"));

            array_push($whereFieldAndValue,array("nickname","saucisse"));
            array_push($andFieldsAndValues,array("message","test modification via ma library"));

            $query = execWrittingQuerySecured($bdd, "update", "simple_chat", $fieldsAndValues, $whereFieldAndValue, $andFieldsAndValues);
            echo $query;
            */
        ?>

        
    </footer>
</body>
</html>