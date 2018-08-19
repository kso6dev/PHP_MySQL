<?php 
    /*
    this page is used to zoom on an article, to read its full content and access to its comments
    */

    //include my sql library
    include("kso_sqllib.php");

    //init sql connexion
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=test_ocr;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));//to get sql queries better errors
    }
    catch (Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
?>
<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <title>Article</title>
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    </head>
    <body>
        <div id="main_wrapper">
            <header>
                <p>
                    <a href="index.php" title="back to home page">Retour à la liste des billets</a>
                </p>
            </header>
            
            <section>
                <?php
                    if (isset($_GET['id']))
                    {
                        $id = (int) htmlspecialchars($_GET['id']);
                        
                        //$query = $bdd->prepare('SELECT a.title as atitle, a.author as aauthor, a.id as aid, a.content as acontent, a.creation_date as acdate, 
                        //                        a.modification_date as amdate, c.article_id, c.id as cid, c.creation_date as cdate, c.message as cmessage, c.nickname as cnick 
                        //                        FROM article AS a LEFT JOIN comment AS c ON c.article_id = a.id WHERE a.id=:id');
                        $query = $bdd->prepare('SELECT a.title as atitle, a.author as aauthor, a.id as aid, a.content as acontent, a.creation_date as acdate, 
                                                a.modification_date as amdate FROM article AS a WHERE a.id=:id');
                        $query->execute(array(
                            'id' => $id
                        )) or die (print_r($bdd->errorInfo()));
                        
                        $rec = $query->fetch();
                ?>
                        <h2>Zoom sur l'article <?php echo htmlspecialchars($rec['aid']); ?></h2>
                        <article>
                            <h1><?php echo htmlspecialchars($rec['atitle']); ?></h1>
                            <p>
                                Auteur: <?php echo htmlspecialchars($rec['aauthor']); ?> <br>
                                Date de création: <?php echo htmlspecialchars($rec['acdate']); ?> <br>
                                Dernière date de modification: <?php echo htmlspecialchars($rec['amdate']); ?> <br>
                                <span class="content">
                                    <?php echo nl2br(htmlspecialchars($rec['acontent'])); ?>
                                </span>
                            </p>
                        </article>
                        
                        <?php $query->closeCursor(); ?>

                        <div id="comments">
                            <h3>Commentaires</h3>
                            <?php
                            $first = 0;
                            if (isset($_GET['page']))
                            {
                                $pageno = (int) htmlspecialchars($_GET['page']);
                                $first = $first + (($pageno - 1) * 5);
        
                            }
                            $query = $bdd->prepare('SELECT c.article_id, c.id, c.creation_date as cdate, c.message as cmessage, c.nickname as cnick 
                                                    FROM comment AS c WHERE c.article_id=:id ORDER BY c.id LIMIT '.$first.',5');
                            $query->execute(array(
                                'id' => $id
                            )) or die (print_r($bdd->errorInfo()));

                            while ($rec = $query->fetch())
                            {
                            ?>
                                <p>
                                    Pseudo: <?php echo htmlspecialchars($rec['cnick']); ?> <br>
                                    Date : <?php echo htmlspecialchars($rec['cdate']); ?> <br>
                                    <?php echo nl2br(htmlspecialchars($rec['cmessage'])); ?>
                                </p>
                            <?php
                            }
                            $query->closeCursor();
                            ?>                            
                            <form method="post" action="comment_post.php">
                                Ajouter un commentaire: <br>
                                <label for="nickname">Pseudo</label>: <input type="text" id="nickname" name="nickname">
                                <textarea name="message" id="message" cols="50" rows="1"> </textarea>
                                <input type="submit" id="submit" value="poster">
                                <input type="hidden" id="articleid" name="articleid" value=<?php echo '"'.$id.'"' ?>>
                            </form>
                        </div>

                <?php  
                    }
                ?>
            </section>
            
            <footer>
            <?php 
                $parentPageName = 'comments.php';
                $tableToCount = 'comment';
                $rangeToDisplay = 5;
                include('pages.php'); 
            ?>
            </footer>
        </div>
    </body>
</html>