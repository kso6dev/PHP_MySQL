<?php
require('controller/controller.php');

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
}
else
{
    listArticles();
}