<?php
session_start();
$index_session_nickname = '';

if (isset($_SESSION['nickname']))
{
    $index_session_nickname = htmlspecialchars($_SESSION['nickname']);
}
?>
<!DOCTYPE <!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>lasaucisseduweb</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
</head>
<body>
    <header>
        <?php include('navmenu.php'); ?>
    </header>

        <h1>Bienvenue sur lasaucisseduweb, le site de la saucisse du web, plus connue sous le nom de soseji-k</h1>
        
        <?php
        if ($index_session_nickname == '')
        {
            include('welcome.php');
        }
        else
        {
            echo 'Bienvenue '.$index_session_nickname.', j\'espère que tu vas bien aujourd\'hui. <br>';
            ?>
            <form method="post" action="logout_post.php">
                <input type="submit" id="logoutbutton" value="Se déconnecter">
                <input type="hidden" name="logout" value="go">
            </form>
        <?php
        }
        ?>

    <footer>

    </footer>

    <script src="main.js"></script>
</body>
</html>