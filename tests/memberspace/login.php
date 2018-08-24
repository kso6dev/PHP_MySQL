<!DOCTYPE <!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Connexion</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    <h3>Connexion</h3>
    <form method="post" action="login_post.php">
        <label for="nickname">Pseudo</label>: <input type="text" id="nickname" name="nickname">
        <br>
        <label for="pwd">Mot de passe</label>: <input type="password" id="pwd" name="pwd">
        <br>
        <input type="submit" id="accesstologin" value="Se connecter">
        <input type="hidden" name="accesstologin" value="go">
    </form>
</body>
</html>
