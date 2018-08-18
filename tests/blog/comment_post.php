<?php 
    /*
    this page is only used to insert new comments, not seen by user
    */

    //include my sql library
    include("kso_sqllib.php");

    $message = '';
    $nickname = '';
    if (isset($_POST['message']) AND isset($_POST['nickname']) AND isset($_POST['articleid']))
    {
        $nickname = htmlspecialchars($_POST['nickname']);
        $message = htmlspecialchars($_POST['message']);
        $articleid = (int) htmlspecialchars($_POST['articleid']);
        //init sql connexion
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=test_ocr;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));//to get sql queries better errors
        }
        catch (Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }

        //insert comment
        if (($message != '') AND ($nickname != '') AND ($articleid != 0))
        {
            $fieldsAndValues = array();
            $andFieldsAndValues = array();
            $whereFieldAndValue = array();
            array_push($fieldsAndValues,array("article_id", $articleid));
            array_push($fieldsAndValues,array("nickname", $nickname));
            array_push($fieldsAndValues,array("message", $message));
            
            $query = execWrittingQuerySecured($bdd, "insert", "comment", $fieldsAndValues, $whereFieldAndValue, $andFieldsAndValues);
            echo $query;
        }
        
    }

    //redirect to comments page
    header('Location: comments.php?id='.$articleid);
?>