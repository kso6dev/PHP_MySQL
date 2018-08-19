<?php
    if ($parentPageName == "comments.php")
    {
        $query = $bdd->query('SELECT COUNT(*) as acount FROM '.$tableToCount.' WHERE article_id='.$id) or die (print_r($bdd->errorInfo()));
    }
    else
    {
        $query = $bdd->query('SELECT COUNT(*) as acount FROM '.$tableToCount) or die (print_r($bdd->errorInfo()));
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
            if ($parentPageName == 'comments.php')
            {
                echo '<a href="'.$parentPageName.'?id='.$id.'&page='.$i.'" title="pageno" >'.$i.'</a>';
            }
            else
            {
                echo '<a href="'.$parentPageName.'?page='.$i.'" title="pageno" >'.$i.'</a>';
            }
            if ($i < $nbOfPage)
            {
                echo ',  ';
            }
        }
    }
?>