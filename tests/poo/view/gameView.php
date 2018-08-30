<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <title>Hero game</title>
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/main.css" />
    </head>
    <body>
        <div id="main_wrapper">
            <h1>Play with your hero!</h1>
            <form method="post" action="index.php">
                <p>
                    <label for="name">Name</label>: <input type="text" id="name" name="name" maxlength="30">
                    <br>
                    <input type="submit" name="create" value="Create new hero">  
                    <input type="submit" name="choose" value="Choose this hero">
                </p>
            </form>
        </div>
    </body>
</html>