<?php
    /*
    this page is the blog main page. it displays a list of the 5 last articles
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
        <title>Blog</title>
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    </head>
    <body>
        <div id="main_wrapper">
            <header>
                <h2>Mon blog!</h2>
            </header>
            
            <section>
                <h3>Liste des articles</h3>
                <?php
                    $query = $bdd->query('SELECT * FROM article ORDER BY creation_date DESC') or die (print_r($bdd->errorInfo()));
                    while ($rec = $query->fetch())
                    {
                ?>

                        <article>
                            <h1><?php echo htmlspecialchars($rec['title']); ?></h1>
                            <p>
                                Auteur: <?php echo htmlspecialchars($rec['author']); ?> <br>
                                Date de création: <?php echo htmlspecialchars($rec['creation_date']); ?> <br>
                                Dernière date de modification: <?php echo htmlspecialchars($rec['modification_date']); ?> <br>
                                <span class="content">
                                    <?php echo nl2br(htmlspecialchars($rec['content'])); ?>
                                </span>
                                <br>
                                <a href=<?php echo '"comments.php?id='.$rec['id'].'"'; ?> title="comments page"> <em>Zoom</em> </a>                        
                            </p>
                        </article>
                <?php
                    }
                    $query->closeCursor();
                ?>
            </section>
            
            <footer>
            
            </footer>
        </div>
    </body>
</html>