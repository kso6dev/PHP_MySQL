<?php
    /*
    this page is an admin page protected by htaccess. It looks like the blog main page
    but user can choose to modify or remove articles
    */

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
        <title>Blog admin</title>
        <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    </head>
    <body>
        <div id="main_wrapper">
            <header>
                <h2>J'admin mon blog!</h2>
            </header>
            
            <section>
                <p>
                    <a href="modifyorremove.php?a=1" title="insert">Insérer un nouvel article</a>,
                </p>
                <h3>Liste des articles</h3>
                <?php
                    $first = 0;
                    if (isset($_GET['page']))
                    {
                        $pageno = (int) htmlspecialchars($_GET['page']);
                        $first = $first + (($pageno - 1) * 3);

                    }
                    $query = $bdd->query('SELECT * FROM article ORDER BY creation_date DESC LIMIT '.$first.',3') or die (print_r($bdd->errorInfo()));
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
                                <a href=<?php echo '"modifyorremove.php?a=2&id='.htmlspecialchars($rec['id']).'"'; ?> title="modify">Modifier</a>, 
                                <a href=<?php echo '"modifyorremove.php?a=3&id='.htmlspecialchars($rec['id']).'"'; ?> title="remove">Supprimer</a>
                            </p>
                        </article>
                <?php
                    }
                    $query->closeCursor();
                ?>
            </section>
            
            <footer>
                <?php 
                $parentPageName = 'modify.php';
                $tableToCount = 'article';
                $rangeToDisplay = 3;
                include('../pages.php'); 
                ?>
            </footer>
        </div>
    </body>
</html>