<?php
    //starting session before any html code
    session_start();

    $nickname = '';
    $logged = false;
    $instruction = '';

    //check if user is connected (by session)
    if (isset($_SESSION['nickname']))
    {
        $logged = true;
        $nickname = htmlspecialchars($_SESSION['nickname']);
    }
    else //check if user try to connect and if ok we will create its session
    if (isset($_POST['login']))
    {
        if ($_POST['login'] == "go")
        {
            if (isset($_POST['nickname']))
            {
                $nickname = htmlspecialchars($_POST['nickname']);
            }
            if ($nickname != '')
            {
                $logged = true;
                $_SESSION["nickname"] = $nickname;
            }
            else
            {
                $logged = false;
                $instruction = 'Vous devez renseigner votre pseudo pour pouvoir accéder au chat:';
            }
        }
    }
    
    //check if deconnexion then destroy session vars
    if (isset($_POST['logout']))
    {
        if ($_POST['logout'] == "go")
        $logged = false;
        session_destroy();
    }
    
?>
<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Accueil chat</title>
</head>
<body>
    <?php 
    if (!$logged)
    {
        if ($instruction == "")
        {
            $instruction = 'Veuillez vous identifier pour accéder au chat:';
        }
    ?>
        <form method="post" action="index.php">
            <?php echo $instruction; ?> <br>
            <label for="nickname">Pseudo</label>: <input type="text" name="nickname" id="nickname"> <br>
            <input type="submit" id="connection" value="connexion">
            <input type="hidden" name="login" id="login" value="go"> <br>
        </form>
    <?php
    }
    else
    {
    ?>
        <form method="post" action="minichat_post.php">
            Bonjour <?php echo $nickname; ?>! <br>
            Vous pouvez poster votre message: <br>
            <textarea name="message" id="message" cols="50" rows="1"> </textarea>
            <input type="submit" id="submit" value="envoyer">
            <input type="hidden" id="nickname" name="nickname" value=<?php echo '"'.$nickname.'"';?>>
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
                <?php
                $time = strtotime($rec['date']);
                $date = date('d/m/Y', $time);
                $hour = date('H:i:s', $time);
                echo 'le '.$date.' à '.$hour.', '; 
                ?> - 
                <?php echo $rec['nickname']; ?> a dit:  
                <span style="border: 1px solid grey; padding: 1px 10px 1px 10px;">
                    <em> <?php echo $rec['message']; ?> </em>
                </span>
            </p>
        <?php
        }
        $query->closeCursor();
        ?>
        <form method="post" action="index.php">
            Déconnexion: <br>
            <input type="submit" id="logoutbutton" value="déconnexion">
            <input type="hidden" name="logout" id="logout" value="go">
        </form>
    <?php
    }
    ?>
</body>
</html>