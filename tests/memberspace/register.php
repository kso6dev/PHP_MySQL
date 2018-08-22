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
    <h3>Inscription</h3>
    <form method="post.php" action="register_post.php">
        <label for="nickname">Pseudo</label>: <input type="text" id="nickname" name="nickname">
        <br>
        <label for="pwd">Mot de passe</label>: <input type="password" id="pwd" name="pwd">
        <br>
        <label for="pwdconfirm">Confirmer mot de passe</label>: <input type="password" id="pwdconfirm" name="pwdconfirm">
        <br>
        <label for="email">Mot de passe</label>: <input type="text" id="email" name="email">
        <br>
        <input type="submit" id="accesstoregister" value="S'inscrire">
        <input type="hidden" name="accesstoregister" value="go">
    </form>
</body>
</html>
