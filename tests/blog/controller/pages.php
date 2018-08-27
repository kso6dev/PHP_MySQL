<?php
    try
    {
        $bdd = new PDO('mysql:host=localhost;dbname=test_ocr;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));//to get sql queries better errors
    }
    catch (Exception $e)
    {
        die('Erreur : '.$e->getMessage());
    }
    if ($action == 'listArticles')
    {
        $query = $bdd->query('SELECT COUNT(*) as acount FROM '.$tableToCount) or die (print_r($bdd->errorInfo()));
    }
    else
    {
        $query = $bdd->query('SELECT COUNT(*) as acount FROM '.$tableToCount.' WHERE article_id='.$id) or die (print_r($bdd->errorInfo()));
    }
    $rec = $query->fetch();
    $nbOfArticle = (int) $rec['acount'];
    $query->closeCursor();
    $nbOfPage = 1;
    if ($rangeToDisplay < 1 OR $rangeToDisplay == null)
    {
        $rangeToDisplay = 3;
    }
    if ($nbOfArticle > $rangeToDisplay)
    {
        $nbOfPage += floor(($nbOfArticle - 1) / $rangeToDisplay);
    }

    if ($nbOfPage > 1)
    {
        echo 'Page: ';
        for ($i = 1; $i <= $nbOfPage; $i++)
        {
            if ($action == 'listArticles')
            {
                echo '<a href="index.php?action='.$action.'&page='.$i.'" title="pageno" >'.$i.'</a>';
            }
            else
            if ($action == 'showArticle')
            {
                echo '<a href="index.php?action='.$action.'&id='.$id.'&page='.$i.'" title="pageno" >'.$i.'</a>';
            }

            if ($i < $nbOfPage)
            {
                echo ',  ';
            }
        }
    }
