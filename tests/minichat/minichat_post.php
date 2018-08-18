<?php
    //this page is only for php code
    //user will never see it


    //use my library
    include("kso_sqllib.php");

    $message = '';
    $nickname = '';
    if (isset($_POST['message']) AND isset($_POST['nickname']))
    {
        $nickname = htmlspecialchars($_POST['nickname']);
        $message = htmlspecialchars($_POST['message']);

        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=test_ocr;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));//to get sql queries better errors
        }
        catch (Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }

        if (($message != '') AND ($nickname != ''))
        {
            $fieldsAndValues = array();
            $andFieldsAndValues = array();
            $whereFieldAndValue = array();
            array_push($fieldsAndValues,array("nickname", $nickname));
            array_push($fieldsAndValues,array("message", $message));
            
            $date = date('Y-m-d H:i:s');
            array_push($fieldsAndValues,array("creation_date", $date));
            $query = execWrittingQuerySecured($bdd, "insert", "simple_chat", $fieldsAndValues, $whereFieldAndValue, $andFieldsAndValues);
            echo $query;
        }
        
    }

    //redirection to index.php
    header('Location: index.php');
    /*
    
    array_push($whereFieldAndValue,array("nickname","saucisse"));
    array_push($andFieldsAndValues,array("message","test modification via ma library"));

    $query = execWrittingQuerySecured($bdd, "update", "simple_chat", $fieldsAndValues, $whereFieldAndValue, $andFieldsAndValues);
    echo $query;
    */

    
?>
