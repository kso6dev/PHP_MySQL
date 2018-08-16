<!DOCTYPE <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Form db modifications</title>
</head>
<body>
    <form method="post" action="insertion.php">
        Renseignez les infos ci-après pour intéragir avec la table video_games de la base test_ocr: <br>
        <label for="insert">Insert</label> <input type="radio" name="requesttype" id="insert" value="insert"> <br>
        <label for="update">Update</label> <input type="radio" name="requesttype" id="update" value="update"> <br>
        <label for="delete">Delete</label> <input type="radio" name="requesttype" id="delete" value="delete"> <br>

        <label for="owner">Je suis</label>: <input type="text" id="owner" name="owner"> <br>
        <label for="name">Nom du jeu</label>: <input type="text" id="name" name="name"> <br>
        <label for="console">Jouable sur (nom console)</label>: <input type="text" id="console" name="console"> <br>
        <label for="max_players">Nombre max de joueurs</label>: <input type="text" id="max_players" name="max_players"> <br>
        <label for="price">Prix</label>: <input type="text" id="price" name="price"> <br>
        
        Commentaires: <br>
        <textarea name="comments" id="comments" cols="80" rows="10">

        </textarea>

        <br>

        <input type="submit" id="submit" value="envoyer">
    </form>
</body>
</html>