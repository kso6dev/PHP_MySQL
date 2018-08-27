<?php
function getArticles($firstarticleno, $nbofarticletodisplay)
{
    $bdd = connectDB();

    $query = $bdd->query('SELECT * FROM article ORDER BY creation_date DESC LIMIT '.$firstarticleno.','.$nbofarticletodisplay) or die (print_r($bdd->errorInfo()));

    return $query;
}

function getArticle($id)
{
    
    $bdd = connectDB();

    $query = $bdd->prepare('SELECT a.title as atitle, a.author as aauthor, a.id as aid, a.content as acontent, a.creation_date as acdate, 
                                                                                a.modification_date as amdate FROM article AS a WHERE a.id=:id');
    
    $query->execute(array(
        'id' => $id
    )) or die (print_r($bdd->errorInfo()));
    
    $rec = $query->fetch();
    
    $query->closeCursor();

    return $rec;
}

function getComments($articleid, $firstcommentid, $nbofcomtodisplay)
{

    $bdd = connectDB();

    $query = $bdd->prepare('SELECT c.article_id, c.id, c.creation_date as cdate, c.message as cmessage, c.nickname as cnick 
                                                    FROM comment AS c WHERE c.article_id=:id ORDER BY c.id LIMIT '.$firstcommentid.','.$nbofcomtodisplay);
    
    $query->execute(array(
        'id' => $articleid
    )) or die (print_r($bdd->errorInfo()));

    return $query;
}

function connectDB()
{
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=test_ocr;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));//to get sql queries better errors
    }
    catch (Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
    return $bdd;
}