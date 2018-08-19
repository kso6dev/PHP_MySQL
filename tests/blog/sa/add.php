<?php
/*
this page is protected by htaccess and is used to add new article on my blog
*/

//init var
$add = false;
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
//we found no error so we can insert user data
if ($add)
{
    //get data
    $author = htmlspecialchars($_POST['author']);
    $title = htmlspecialchars($_POST['title']);
    $content = htmlspecialchars($_POST['content']);

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
    array_push($fieldsAndValues,array("author", $author));
    array_push($fieldsAndValues,array("title", $title));
    array_push($fieldsAndValues,array("content", $content));
    
    $query = execWrittingQuerySecured($bdd, "insert", "article", $fieldsAndValues, $whereFieldAndValue, $andFieldsAndValues);

    //redirect to index page
    header('Location: ../index.php');
}
?>
<!DOCTYPE <!DOCTYPE html>
<html lang="fr-FR">
    <head>
        <meta charset="utf-8" />
        <title>Ajouter un article</title>
    </head>
    <body>
        <h1>Ajouter un article</h1>
        <form method="post" action="add.php">
            <label for="author">Auteur</label>: <input type="text" id="author" name="author" value="so6"> <br>
            <label for="title">Titre</label>: <input type="text" id="title" name="title"> <br>
            <textarea name="content" id="content" cols="100" rows="20"></textarea> <br>
            <input type="submit" id="submit" name="submmit" value="Envoyer">
            <input type="hidden" id="add" name="add" value="add">
        </form>
    </body>
</html>