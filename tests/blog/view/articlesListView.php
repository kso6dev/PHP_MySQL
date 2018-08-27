<!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <title>Blog</title>
        <link rel="stylesheet" type="text/css" media="screen" href="public/css/main.css" />
    </head>
    <body>
        <div id="main_wrapper">
            <header>
                <h2>Mon blog!</h2>
            </header>
            
            <section>
                <h3>Liste des articles</h3>
                <?php
                    while ($article = $articles->fetch())
                    {
                ?>

                        <article>
                            <h1><?= htmlspecialchars($article['title']) ?></h1>
                            <p>
                                Auteur: <?= htmlspecialchars($article['author']) ?> <br>
                                Date de création: <?= htmlspecialchars($article['creation_date']) ?> <br>
                                Dernière date de modification: <?= htmlspecialchars($article['modification_date']) ?> <br>
                                <span class="content">
                                    <?= nl2br(htmlspecialchars($article['content'])) ?>
                                </span>
                                <br>
                                <a href=<?= '"index.php?action=showArticle&id='.$article['id'].'"' ?> title="comments page"> <em>Zoom</em> </a>                        
                            </p>
                        </article>
                <?php
                    }
                ?>
            </section>
            
            <footer>
                <?php 
                include('controller/pages.php'); 
                ?>
            </footer>
        </div>
    </body>
</html>
