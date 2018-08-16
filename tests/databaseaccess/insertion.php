<!DOCTYPE <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Video_games table data</title>
    </head>
    <body>      
        <ol>
            <?php
                try
                {
                    $bdd = new PDO('mysql:host=localhost;dbname=test_ocr;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));//to get sql queries better errors
                }
                catch (Exception $e)
                {
                    die('Erreur : '.$e->getMessage());
                }
            
                if (isset($_POST["name"]) AND isset($_POST["requesttype"]))
                {
                    $requestType = htmlspecialchars($_POST["requesttype"]);//radiobutton
                    $name = htmlspecialchars($_POST["name"]);
                    $owner = '';
                    $console = '';
                    $max_players = 1;
                    $price = 0;
                    
                    $nbOfRecUpdate = 0;
                    
                    if (isset($_POST["owner"]))
                    {
                        $owner = htmlspecialchars($_POST["owner"]);
                    } 
                    if (isset($_POST["console"]))
                    {
                        $console = htmlspecialchars($_POST["console"]);
                    }
                    if (isset($_POST["max_players"]))
                    {
                        $max_players = (int)htmlspecialchars($_POST["max_players"]);
                    }
                    if (isset($_POST["price"]))
                    {
                        $price = (double)htmlspecialchars($_POST["price"]);
                    }
                    $comments = "";
                    if (isset($_POST["comments"]))
                    {
                        $comments = htmlspecialchars($_POST["comments"]);
                    }

                    if ($requestType == 'insert')
                    {
                        $req = $bdd->prepare('insert into video_games(name, owner, console, max_players, price, comments) values(:name, :owner, :console, :max_players, :price, :comments)');
                        $nbOfRecUpdate = $req->execute(array(
                            'name'=>$name, 
                            'owner'=>$owner, 
                            'console'=>$console, 
                            'max_players'=>$max_players, 
                            'price'=>$price, 
                            'comments'=>$comments
                        )) or die(print_r($bdd->errorInfo()));
                        $req->closeCursor();
                    }
                    else if ($requestType == 'update')
                    {
                        $req = $bdd->prepare('select id from video_games where name=:name');
                        $req->execute(array(
                            'name'=>$name
                        )) or die(print_r($bdd->errorInfo()));
                        $result = $req->fetch();
                        $id = $result["id"];
                        $req->closeCursor();

                        $req = $bdd->prepare('update video_games SET owner=:owner, console=:console, max_players=:max_players, price=:price, comments=:comments where id=:id');
                        $nbOfRecUpdate = $req->execute(array(
                            'owner'=>$owner, 
                            'console'=>$console, 
                            'max_players'=>$max_players, 
                            'price'=>$price, 
                            'comments'=>$comments,
                            'id'=>$id
                        )) or die(print_r($bdd->errorInfo()));
                        $req->closeCursor();
                    }
                    else if ($requestType == 'delete')
                    {
                        $req = $bdd->prepare('delete from video_games where name=:name');
                        $nbOfRecUpdate = $req->execute(array(
                            'name'=>$name
                        )) or die(print_r($bdd->errorInfo()));
                        $req->closeCursor();
                    }
                    echo 'Le soi-disant compteur d\'enregistrements impactés ne marche pas car il affiche toujours'.$nbOfRecUpdate.'.. A POTASSER! <br>';
                }
                else
                {
                    echo 'malheureusement vous n\'avez pas renseigné les champs nécessaires... <br>';
                }
                $result = $bdd->query('select * from video_games') or die(print_r($bdd->errorInfo()));
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
                $result->closeCursor();
            ?>
        </ol>
            
    </body>
</html>