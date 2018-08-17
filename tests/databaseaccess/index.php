<?php
try
{
    //$bdd = new PDO('mysql:host=localhost;dbname=test_ocr;charset=utf8', 'root', '');
    $bdd = new PDO('mysql:host=localhost;dbname=test_ocr;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));//to get sql queries better errors
}
catch (Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>DatabaseAccess</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
</head>
<body>
    <a href="form.php">Page avec form pour insert into video_games table</a>
    <ol>
    <?php
    $result = $bdd->query('select * from video_games');
    while ($rec = $result->fetch())
    {
        ?>
        <li>
            <strong><?php echo $rec['name']; ?></strong><br>
            Le possesseur de ce jeu est : <?php echo $rec['owner']; ?> et il le vend à
            <?php echo $rec['price']; ?> euros. <br>
            Ce jeu fonctionne sur <?php echo $rec['console']; ?> et on peut y jouer à 
            <?php echo $rec['max_players']; ?> max. <br>
            Commentaires de <?php echo $rec['owner']; ?>: <br>
            <em><?php echo $rec['comments']; ?></em> 
         </li>
         <br>
        <?php
    }
    ?>
    </ol>
    <br>
    <h4>Voici la liste des jeux Xbox:</h4>
    <p>
        <?php
        $result->closeCursor();
        $result = $bdd->query('select UPPER(name) as name_up, console from video_games where console=\'Xbox\' ORDER BY name DESC') or die(print_r($bdd->errorInfo()));
        while ($rec = $result->fetch())
        {   
            echo $rec['name_up'].'<br>';
        }
        $result->closeCursor();
        ?>
    </p>
    <h4>Utilisation d'une requête préparée pour éviter injection SQL, on attend le param 'owner'</h4>
        <p>
            voici les jeux de <?php echo htmlspecialchars($_GET['owner']); ?> : <br>

        <?php
        $req = $bdd->prepare('select name from video_games where owner = ?');
        $req->execute(array(htmlspecialchars($_GET['owner'])));
        while ($rec = $req->fetch())
        {   
            echo $rec['name'].' <br>'; 
        }
        $req->closeCursor();
        ?>

        </p>
        <h4>Utilisation d'une requête préparée pour éviter injection SQL, on attend les param 'owner' et 'maxprice'</h4>
        <p>
            voici les jeux de <?php echo htmlspecialchars($_GET['owner']); ?> dont le prix ne dépasse pas <?php echo htmlspecialchars($_GET['maxprice']) ?> : <br>

        <?php
        $req = $bdd->prepare('select name from video_games where owner = :owner AND price <= :maxprice');
        $req->execute(array('owner'=>htmlspecialchars($_GET['owner']), 'maxprice'=>htmlspecialchars($_GET['maxprice'])));
        while ($rec = $req->fetch())
        {   
            echo $rec['name'].' <br>'; 
        }
        $req->closeCursor();
        ?>

        </p>
    </body>
</html>
