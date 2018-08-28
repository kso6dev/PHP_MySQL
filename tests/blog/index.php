<?php
require('controller/controller.php');

try
{
    if (isset($_GET['action']))
    {
        $action = htmlspecialchars($_GET['action']);

        if ($action == 'listArticles')
        {
            listArticles();
        }
        else
        if ($action == 'showArticle')
        {
            showArticle();
        }
        else
        if ($action == 'addComment')
        {
            if (isset($_GET['id']))
            {
                $articleid = (int) htmlspecialchars($_GET['id']);
                $message = '';
                $nickname = '';
                if (isset($_POST['message']) AND isset($_POST['nickname']))
                {
                    $nickname = htmlspecialchars($_POST['nickname']);
                    $message = htmlspecialchars($_POST['message']);
                    if (($message != '') AND ($nickname != '') AND ($articleid != 0))
                    {
                        addComment($nickname, $message, $articleid);
                    }
                    else
                    {
                        throw new Exception('il faut préciser un pseudo et un message');
                    }
                }
                else
                {
                    throw new Exception('il faut préciser un pseudo et un message');
                }
            }
            else
            {
                throw new Exception('aucun id de billet envoyé');
            }
        }
    }
    else
    {
        listArticles();
    }
}
catch(Exception $e)
{
    $errorMessage = $e->getMessage();
    require('view/errorView.php');
}