<?php
namespace sosejik\tests\blog\model;

require_once('model/Manager.php');

class CommentManager extends Manager
{

    function getComments($articleid, $firstcommentid, $nbofcomtodisplay)
    {

        $bdd = $this->connectDB();

        $query = $bdd->prepare('SELECT c.article_id, c.id as cid, DATE_FORMAT(c.creation_date, "le %d/%m/%Y à %Hh%imin%ss") as cdate, 
                                        c.message as cmessage, c.nickname as cnick 
                                            FROM comment AS c WHERE c.article_id=:id ORDER BY cid LIMIT '.$firstcommentid.','.$nbofcomtodisplay);
        
        $query->execute(array(
            'id' => $articleid
        )) or die (print_r($bdd->errorInfo()));

        return $query;
    }

    function getComment($articleid, $commentid)
    {

        $bdd = $this->connectDB();

        $query = $bdd->prepare('SELECT c.article_id, c.id as cid, DATE_FORMAT(c.creation_date, "le %d/%m/%Y à %Hh%imin%ss") as cdate, 
                                        c.message as cmessage, c.nickname as cnick 
                                            FROM comment AS c WHERE c.article_id=:id AND c.id=:cid');
        
        $query->execute(array(
            'id' => $articleid,
            'cid' => $commentid
        )) or die (print_r($bdd->errorInfo()));

        $rec = $query->fetch();
        $query->closeCursor();
        return $rec;
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

    public function modifyComment($nickname, $message, $articleid, $commentid)
    {
        include("kso_sqllib.php");
        
        $bdd = $this->connectDB();

        //update comment
        $fieldsAndValues = array();
        $andFieldsAndValues = array();
        $whereFieldAndValue = array();
        array_push($fieldsAndValues,array("nickname", $nickname));
        array_push($fieldsAndValues,array("message", $message));
        array_push($whereFieldAndValue,array("id", $commentid));
        array_push($andFieldsAndValues,array("article_id", $articleid));
        
        $nbOfRec = execWrittingQuerySecured($bdd, "update", "comment", $fieldsAndValues, $whereFieldAndValue, $andFieldsAndValues);
        return $nbOfRec;
    }
}