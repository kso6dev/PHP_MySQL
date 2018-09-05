<?php

require 'public/lib/autoload.php';

$db = DBFactory::getMysqlConnectionWithPDO();
$manager = new NewsManagerPDO($db);
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>News: Accueil</title>
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/main.css" />
</head>
<body>
    <div id="main_wrapper">
        <h1>News: Accueil</h1>
        <p>
            <a href="admin.php">Accéder à l'espace d'administration</a>
        </p>
        <?php
        if (isset($_GET['id']))
        {
            $news = $manager->get($_GET['id']);
            echo '<p>Par <em>', $news->author(), '</em>, le ', $news->creation_date()->format('d/m/Y à H\hi'), '</p>', "\n",
                '<h2>', htmlspecialchars($news->title()), '</h2>', "\n",
                '<p>', nl2br($news->content()), '</p>', "\n";

            if ($news->creation_date() != $news->modification_date())
            {
                echo '<p style="text-align: right;"><small><em>Modifiée le ', $news->modification_date()->format('d/m/Y à H\hi'), '</em></small></p>';
            }
        }
        else
        {
            echo '<h2 style="text-align: center;">Liste des 5 dernières news</h2>';
            foreach ($manager->getList(0, 5) as $news)
            {
                if (strlen($news->content()) <= 200)
                {
                    $content = $news->content();
                }
                else
                {
                    $contentstart = substr($news->content(), 0, 200);
                    $contentstart = substr($contentstart, 0, strrpos($contentstart, ' ')) . '...';
                    $content = $contentstart;
                }
                
                echo '<h4><a href="?id=', $news->id(), '">', $news->title(), '</a></h4>', "\n",
                    '<p>', nl2br($content), '</p>';
            }
        }
        ?>
    </div>
</body>
</html>