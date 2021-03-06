<?php
    $register_ermsg = '';
    if (isset($_GET['ermsg']))
    {
        $register_ermsg = htmlspecialchars($_GET['ermsg']);
    }
?>
<!DOCTYPE <!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inscription</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <header>
        <?php include('navmenu.php'); ?>
    </header>
    <h3>Inscription</h3>
    <form method="post" action="register_post.php">
        <label for="nickname">Pseudo</label>: <input type="text" id="nickname" name="nickname" required>
        <br>
        <label for="pwd">Mot de passe</label>: <input type="password" id="pwd" name="pwd" required>
        <br>
        <label for="pwdconfirm">Confirmer mot de passe</label>: <input type="password" id="pwdconfirm" name="pwdconfirm" required>
        <br>
        <label for="email">Adresse e-mail</label>: <input type="text" id="email" name="email" required>
        <br>
        <input type="submit" id="accesstoregister" value="S'inscrire">
        <input type="hidden" name="accesstoregister" value="go">
    </form>
    <?php
        if ($register_ermsg != '')
        {
            echo '<div class="ermsg"><p>'.$register_ermsg.'</p></div>';
        }
    ?>
</body>
</html>
