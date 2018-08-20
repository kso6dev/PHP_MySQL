<?php
/*
this page is protected by htaccess and is used to add, modify or delete article on my blog
*/

//init var
$add = false;
$modify = false;
$remove = false;
$updateid = 0;
$errormessage = '';

//check if user has post to insert a new article
if (isset($_POST['add']) AND (htmlspecialchars($_POST['add']) == 'add'))
{
    //check if user has specified all necessary fields
    if (!isset($_POST['author']) OR $_POST['author'] == '')
    {
        $errormessage = 'Il faut préciser l\'auteur de l\'article.';
    }
    if (!isset($_POST['title']) OR $_POST['title'] == '')
    {
        if ($errormessage != '')
        {
            $errormessage = $errormessage.'<br>';
        }
        $errormessage = 'Il faut préciser le titre de l\'article.';
    }
    if (!isset($_POST['content']) OR $_POST['content'] == '')
    {
        if ($errormessage != '')
        {
            $errormessage = $errormessage.'<br>';
        }
        $errormessage = 'L\'article n\'a pas de contenu!';
    }
    //if no error found, we can insert
    if ($errormessage == '')
    {
        $add = true;
    }
}
else
//check if user has post to modify an article
if (isset($_POST['modify']) AND (htmlspecialchars($_POST['modify']) == 'modify'))
{
    //check if user has specified all necessary fields
    if (!isset($_POST['author']) OR $_POST['author'] == '')
    {
        $errormessage = 'Il faut préciser l\'auteur de l\'article.';
    }
    if (!isset($_POST['title']) OR $_POST['title'] == '')
    {
        if ($errormessage != '')
        {
            $errormessage = $errormessage.'<br>';
        }
        $errormessage = 'Il faut préciser le titre de l\'article.';
    }
    if (!isset($_POST['content']) OR $_POST['content'] == '')
    {
        if ($errormessage != '')
        {
            $errormessage = $errormessage.'<br>';
        }
        $errormessage = 'L\'article n\'a pas de contenu!';
    }
    if (!isset($_POST['updateid']))
    {
        if ($errormessage != '')
        {
            $errormessage = $errormessage.'<br>';
        }
        $errormessage = 'L\'id de l\'article n\'est pas précisé, contactez votre admin.';
    }
    $updateid = (int) htmlspecialchars($_POST['updateid']);
    if ($updateid == 0)
    {
        if ($errormessage != '')
        {
            $errormessage = $errormessage.'<br>';
        }
        $errormessage = 'L\'id de l\'article n\'est pas précisé, contactez votre admin.';
    }
    //if no error found, we can modify
    if ($errormessage == '')
    {
        $modify = true;
    }
}
else
//check if user has post to remove an article
if (isset($_POST['remove']) AND (htmlspecialchars($_POST['remove']) == 'remove'))
{
    if (!isset($_POST['removeid']))
    {
        if ($errormessage != '')
        {
            $errormessage = $errormessage.'<br>';
        }
        $errormessage = 'L\'id de l\'article n\'est pas précisé, contactez votre admin.';
    }
    $updateid = (int) htmlspecialchars($_POST['removeid']);
    if ($updateid == 0)
    {
        if ($errormessage != '')
        {
            $errormessage = $errormessage.'<br>';
        }
        $errormessage = 'L\'id de l\'article n\'est pas précisé, contactez votre admin.';
    }
    //if no error found, we can remove
    if ($errormessage == '')
    {
        $remove = true;
    }
}
//we found no error so we can insert, modify or remove 
if ($add OR $modify OR $remove)
{
    if ($add OR $modify)
    {
        //get data
        $author = htmlspecialchars($_POST['author']);
        $title = htmlspecialchars($_POST['title']);
        $content = htmlspecialchars($_POST['content']);
    }
   
    //include my sql library
    include("../kso_sqllib.php");

    //init sql connexion
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=test_ocr;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));//to get sql queries better errors
    }
    catch (Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }

    $fieldsAndValues = array();
    $andFieldsAndValues = array();
    $whereFieldAndValue = array();
    
    if ($add OR $modify)
    {
        array_push($fieldsAndValues,array("author", $author));
        array_push($fieldsAndValues,array("title", $title));
        array_push($fieldsAndValues,array("content", $content));
        $date = date('Y-m-d H:i:s');
        array_push($fieldsAndValues,array("modification_date", $date));
    }
    if ($modify OR $remove)
    {
        array_push($whereFieldAndValue,array("id", $updateid));
    }    
    if ($add)
    {
        $query = execWrittingQuerySecured($bdd, "insert", "article", $fieldsAndValues, $whereFieldAndValue, $andFieldsAndValues);
    }
    else if ($modify)
    {
        $query = execWrittingQuerySecured($bdd, "update", "article", $fieldsAndValues, $whereFieldAndValue, $andFieldsAndValues);
    }
    else if ($remove)
    {
        $query = execWrittingQuerySecured($bdd, "delete", "article", $fieldsAndValues, $whereFieldAndValue, $andFieldsAndValues);
    }

    //redirect to index page
    header('Location: modify.php');
}
?>
<!DOCTYPE <!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <title>Ajouter un article</title>
    </head>
    <body>
    <?php
    $action = 0;
    if (isset($_GET['a']))
    {
        $action = (int) htmlspecialchars($_GET['a']);
    }
    if ($action == 0)
    {
        echo '<p>Cette page n\'a pas été appelée correctement, veuillez passer par la page de modification du blog pour insérer un article.</p>';
    }
    else if ($action == 1)
    {
    ?>
        <h1>Ajouter un article</h1>
        <form method="post" action="modifyorremove.php">
            <label for="author">Auteur</label>: <input type="text" id="author" name="author" value="so6"> <br>
            <label for="title">Titre</label>: <input type="text" id="title" name="title"> <br>
            <textarea name="content" id="content" cols="100" rows="20"></textarea> <br>
            <input type="submit" id="submit" name="submit" value="Envoyer">
            <input type="hidden" id="add" name="add" value="add">
        </form>
    <?php
    }
    else if ($action == 2)
    {
        if (isset($_GET['id']))
        {
            $articleid = (int) htmlspecialchars($_GET['id']);
        }
        if ($articleid == 0)
        {
            echo '<p>Cette page n\'a pas été appelée correctement, veuillez passer par la page de modification du blog pour modifier un article.</p>';
        }
        //init sql connexion
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=test_ocr;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));//to get sql queries better errors
        }
        catch (Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
        $query = $bdd->prepare('SELECT * FROM article WHERE id=:id');
        $query->execute(array(
            'id' => $articleid
        )) or die (print_r($bdd->errorInfo()));
        $rec = $query->fetch();
    ?>
        <h1>Modifier un article</h1>
        <form method="post" action="modifyorremove.php">
            <label for="author">Auteur</label>: <input type="text" id="uauthor" name="author" value=<?php echo '"'.htmlspecialchars($rec['author']).'"'; ?>> <br>
            <label for="title">Titre</label>: <input type="text" id="utitle" name="title" value=<?php echo '"'.htmlspecialchars($rec['title']).'"'; ?>> <br>
            <textarea name="content" id="ucontent" cols="100" rows="20"><?php echo htmlspecialchars($rec['content']); ?></textarea> 
            <br>
            <input type="submit" id="usubmit" name="submit" value="Modifier">
            <input type="hidden" id="modify" name="modify" value="modify">
            <input type="hidden" id="updateid" name="updateid" value=<?php echo '"'.$articleid.'"'; ?>>
        </form>
    <?php
    }
    else if ($action == 3)
    {
        if (isset($_GET['id']))
        {
            $articleid = (int) htmlspecialchars($_GET['id']);
        }
        if ($articleid == 0)
        {
            echo '<p>Cette page n\'a pas été appelée correctement, veuillez passer par la page de modification du blog pour supprimer un article.</p>';
        }
        //init sql connexion
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=test_ocr;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));//to get sql queries better errors
        }
        catch (Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
        $query = $bdd->prepare('SELECT * FROM article WHERE id=:id');
        $query->execute(array(
            'id' => $articleid
        )) or die (print_r($bdd->errorInfo()));
        $rec = $query->fetch();
        ?>
            <h1>Supprimer un article</h1>
            <h2><?php echo htmlspecialchars($rec['title']); ?></h2>
            <?php echo 'Auteur: '.htmlspecialchars($rec['author']); ?>
            <p><?php echo nl2br(htmlspecialchars($rec['content'])); ?></p>
            <form method="post" action="modifyorremove.php">
                <input type="submit" id="rsubmit" name="submit" value="Supprimer">
                <input type="hidden" id="remove" name="remove" value="remove">
                <input type="hidden" id="removeid" name="removeid" value=<?php echo '"'.$articleid.'"'; ?>>
            </form>
        <?php
    }
    ?>
    </body>
</html>