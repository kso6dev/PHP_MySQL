<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <title>Intro</title>
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/main.css" />
    </head>
    <body>
        <div id="main_wrapper">
            <h1>Créer un nouveau perso ou choisir un perso existant</h1>
            <form method="post" action="index.php">
                <p>
                    <label for="name">Nom</label>: <input type="text" id="name" name="name" maxlength="30">
                    <br>
                    <input type="submit" name="create" value="Créer ce perso">  
                    <input type="submit" name="choose" value="Choisir ce perso">
                </p>
            </form>
        </div>
    </body>
</html>