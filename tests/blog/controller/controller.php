<?php

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

    require('model/model.php');
    $articles = getArticles($first, 3);
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
            require('model/model.php');

            $article = getArticle($id);

            //comments mgt
            $first = 0;
            if (isset($_GET['page']))
            {
                $pageno = (int) htmlspecialchars($_GET['page']);
                $first = $first + (($pageno - 1) * 5);
            }
            $comments = getComments($id, $first, 5);

            $displaydata = true;

            $action = 'showArticle';
            $tableToCount = 'comment';
            $rangeToDisplay = 5;
        }
    }
    require('view/comments.php');
}