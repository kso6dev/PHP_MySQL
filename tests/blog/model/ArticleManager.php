<?php
namespace sosejik\tests\blog\model;

require_once('model/Manager.php');

class ArticleManager extends Manager
{

    public function getArticles($firstarticleno, $nbofarticletodisplay)
    {
        $bdd = $this->connectDB();

        $query = $bdd->query('SELECT * FROM article ORDER BY creation_date DESC LIMIT '.$firstarticleno.','.$nbofarticletodisplay) or die (print_r($bdd->errorInfo()));

        return $query;
    }

    public function getArticle($id)
    {
        
        $bdd = $this->connectDB();

        $query = $bdd->prepare('SELECT a.title as atitle, a.author as aauthor, a.id as aid, a.content as acontent, a.creation_date as acdate, 
                                                                                    a.modification_date as amdate FROM article AS a WHERE a.id=:id');
        
        $query->execute(array(
            'id' => $id
        )) or die (print_r($bdd->errorInfo()));
        
        $rec = $query->fetch();
        
        $query->closeCursor();

        return $rec;
    }
}