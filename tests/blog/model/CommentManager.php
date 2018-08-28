<?php
namespace sosejik\tests\blog\model;

require_once('model/Manager.php');

class CommentManager extends Manager
{

    function getComments($articleid, $firstcommentid, $nbofcomtodisplay)
    {

        $bdd = $this->connectDB();

        $query = $bdd->prepare('SELECT c.article_id, c.id, c.creation_date as cdate, c.message as cmessage, c.nickname as cnick 
                                                        FROM comment AS c WHERE c.article_id=:id ORDER BY c.id LIMIT '.$firstcommentid.','.$nbofcomtodisplay);
        
        $query->execute(array(
            'id' => $articleid
        )) or die (print_r($bdd->errorInfo()));

        return $query;
    }

    public function insertComment($nickname, $message, $articleid)
    {
        include("kso_sqllib.php");

        $bdd = $this->connectDB();

        //insert comment
        $fieldsAndValues = array();
        $andFieldsAndValues = array();
        $whereFieldAndValue = array();
        array_push($fieldsAndValues,array("article_id", $articleid));
        array_push($fieldsAndValues,array("nickname", $nickname));
        array_push($fieldsAndValues,array("message", $message));
        
        $nbOfRec = execWrittingQuerySecured($bdd, "insert", "comment", $fieldsAndValues, $whereFieldAndValue, $andFieldsAndValues);
        return $nbOfRec;
    }
}