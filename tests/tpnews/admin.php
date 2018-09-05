<?php
require 'public/lib/autoload.php';

$db = DBFactory::getMysqlConnectionWithPDO();
$manager = new NewsManagerPDO($db);

if (isset($_GET['modify']))
{
    $news = $manager->get((int)$_GET['modify']);
}

if (isset($_GET['delete']))
{
    $manager->delete((int)$_GET['delete']);
    $message = 'La news a bien été supprimée';
}

if (isset($_POST['author']))
{
    $news = new News(
        [
            'author' => $_POST['author'],
            'title' => $_POST['title'],
            'content' => $_POST['content']
        ]
    );

    if (isset($_POST['id']))
    {
        $news->setId($_POST['id']);
    }

    if ($news->isValid())
    {
        $manager->save($news);
        $message = $news->isNew() ? 'La news a bien été ajoutée' : 'La news a bien été modifiée';
    }
    else
    {
        $errors = $news->errors();
    }
}
?>
<!DOCTYPE html>
<html lang="fr-FR">
<head>
    <meta charset="utf-8" />
    <title>Administration</title>
    <link rel="stylesheet" type="text/css" media="screen" href="public/css/admin.css" />
</head>
<body>
    <div id="main_wrapper">
        <h1>Administration des news</h1>
        <p>
            <a href=".">Accueil du site</a>
        </p>
        <form action="admin.php" method="post">
            <p>
                <?php
                if (isset($message))
                {
                    echo $message, '<br />';
                }
                ?>
                <?php
                if (isset($errors) && in_array(News::INVALID_AUTHOR, $errors)) echo 'L\'auteur est invalide.<br />';
                ?>
                <label for="author">Auteur</label>: <input type="text" id="author" name="author" value="<?php if (isset($news)) echo $news->author(); ?>"><br />
                <?php
                if (isset($errors) && in_array(News::INVALID_TITLE, $errors)) echo 'Le titre est invalide.<br />';
                ?>
                <label for="title">Titre</label>: <input type="text" id="title" name="title" value="<?php if (isset($news)) echo $news->title(); ?>"><br />
                <?php
                if (isset($errors) && in_array(News::INVALID_CONTENT, $errors)) echo 'Le contenu est invalide.<br />';
                ?>
                Contenu: <br />
                <textarea name="content" id="content" cols="60" rows="10"><?php if (isset($news)) echo $news->content(); ?></textarea><br />
                <?php
                if (isset($news) && !$news->isNew())
                {
                ?>
                    <input type="hidden" name="id" value="<?= $news->id() ?>">
                    <input type="submit" name="modify" value="modify">
                <?php
                }
                else
                {
                ?>
                    <input type="submit" name="add" value="add">
                <?php
                }
                ?>
            </p>
        </form>

        <p>Il y a actuellement <?= $manager->count() ?> news. En voici la liste:</p>

        <table>
            <tr>
                <th>Auteur</th>
                <th>Titre</th>
                <th>Date d'ajout</th>
                <th>Dernière modification</th>
                <th>Action</th>
            </tr>
            <?php
            foreach ($manager->getList() as $news)
            {
                echo '<tr><td>', $news->author(), '</td><td>', $news->title(), '</td><td>', $news->creation_date()->format('d/m/Y à H\hi'),
                '</td><td>', ($news->creation_date() == $news->modification_date() ? '-' : $news->modification_date()->format('d/m/Y à H\hi')),
                '</td><td><a href="?modify=', $news->id(), '">Modifier</a> | <a href="?delete=', $news->id(), '">Supprimer</a></td></tr>', "\n";
            }
            ?>
        </table>
    </div>
</body>
</html>