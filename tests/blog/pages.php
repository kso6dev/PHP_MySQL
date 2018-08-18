<?php
    $query = $bdd->query('SELECT COUNT(*) as acount FROM article') or die (print_r($bdd->errorInfo()));
    $rec = $query->fetch();
    $nbOfArticle = (int) $rec['acount'];
    $query->closeCursor();
    $nbOfPage = 1;
    if ($nbOfArticle > 3)
    {
        $nbOfPage += floor(($nbOfArticle - 1) / 3);
    }

    if ($nbOfPage > 1)
    {
        echo 'Page: ';
        for ($i = 1; $i <= $nbOfPage; $i++)
        {
            echo '<a href="index.php?page='.$i.'" title="pageno" >'.$i.'</a>';
            if ($i < $nbOfPage)
            {
                echo ',  ';
            }
        }
    }
?>