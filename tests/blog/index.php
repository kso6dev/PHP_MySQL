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
        if ($action == 'showComment')
        {
            if (isset($_GET['cid']) AND isset($_GET['id']))
            {
                $commentid = (int) htmlspecialchars($_GET['cid']);
                $articleid = (int) htmlspecialchars($_GET['id']);
                if ($commentid != 0 AND $articleid != 0)
                {
                    showComment($articleid, $commentid);
                }
                else
                {
                    if ($commentid == 0)
                    {
                        throw new Exception('aucun id de commentaire envoyé');
                    }
                    else
                    {
                        throw new Exception('aucun id d\'article envoyé');
                    }
                }
            }
            else
            {
                if (!isset($_GET['cid']))
                {
                    throw new Exception('aucun id de commentaire envoyé');
                }
                else
                {
                    throw new Exception('aucun id d\'article envoyé');
                }
            }
        }
        else
        if (($action == 'addComment') OR ($action == 'updateComment'))
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
                        if ($action == 'addComment')
                        {
                            addComment($nickname, $message, $articleid);
                        }
                        else
                        if (($action == 'updateComment'))
                        {
                            if (isset($_GET['cid']))
                            {
                                $commentid = (int) htmlspecialchars($_GET['cid']);
                                if ($commentid != 0)
                                {
                                    updateComment($nickname, $message, $articleid, $commentid);
                                }
                                else
                                {
                                    throw new Exception('aucun id de commentaire envoyé');
                                }
                            }
                            else
                            {
                                throw new Exception('aucun id de commentaire envoyé');
                            }
                        }
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