<?php

//chargement des classes
require_once('model/ArticleManager.php');
require_once('model/CommentManager.php');

use \sosejik\tests\blog\model\ArticleManager;
use \sosejik\tests\blog\model\CommentManager;

function listArticles()
{
    $first = 0;
    if (isset($_GET['page']))
    {
        $pageno = (int) htmlspecialchars($_GET['page']);
        $first = $first + (($pageno - 1) * 3);
    }
    $action = 'listArticles';
    $tableToCount = 'article';
    $rangeToDisplay = 3;

    $articleManager = new ArticleManager();
    $articles = $articleManager->getArticles($first, 3);
    require('view/articlesListView.php');
    $articles->closeCursor();
}

function showArticle()
{
    $displaydata = false;

    if (isset($_GET['id']))
    {
        $id = (int) htmlspecialchars($_GET['id']);
        
        if ($id != 0)
        {
            $articleManager = new ArticleManager();
            $article = $articleManager->getArticle($id);

            //comments mgt
            $first = 0;
            if (isset($_GET['page']))
            {
                $pageno = (int) htmlspecialchars($_GET['page']);
                $first = $first + (($pageno - 1) * 5);
            }
            $commentManager = new CommentManager();
            $comments = $commentManager->getComments($id, $first, 5);

            $displaydata = true;

            $action = 'showArticle';
            $tableToCount = 'comment';
            $rangeToDisplay = 5;
        }
    }
    require('view/comments.php');
}

function addComment($nickname, $message, $articleid)
{
    $commentManager = new CommentManager();
    $nbOfRec = $commentManager->insertComment($nickname, $message, $articleid);
    
    if ($nbOfRec === false)
    {
        throw new Exception('Impossible d\'ajouter le commentaire.');
    }
    else
    {
        header('Location: index.php?action=showArticle&id='.$articleid);
    }
}

function updateComment($nickname, $message, $articleid, $commentid)
{
    $commentManager = new CommentManager();
    $nbOfRec = $commentManager->modifyComment($nickname, $message, $articleid, $commentid);
    
    if ($nbOfRec === false)
    {
        throw new Exception('Impossible de modifier le commentaire.');
    }
    else
    {
        header('Location: index.php?action=showArticle&id='.$articleid);
    }
}

function showComment($articleid, $commentid)
{
    $commentManager = new CommentManager();
    $comment = $commentManager->getComment($articleid, $commentid);

    require('view/comment.php');
}