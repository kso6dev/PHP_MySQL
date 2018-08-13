<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Envoi fichier</title>
    </head>

    <body>
        <div id="main_wrapper">
            <form method="POST" action="target.php" enctype="multipart/form-data">
                <p>formulaire d'envoi de fichiers</p>
                <br>
                <input type="file" name="myfile">
                <br>
                <input type="submit" value="post file">
            </form>
        </div>
    </body>
</html>