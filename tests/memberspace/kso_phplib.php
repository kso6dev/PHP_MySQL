<?php

    function emailisOk($emailstr)
    {   
        $emailok = false;

        if ($emailstr != null AND $emailstr != '')
        {
            $emailstr = htmlspecialchars($emailstr);

            $emailok = preg_match("/^[a-z0-9._-]+@[a-z0-9._-]{2,}.[a-z]{2,4}$/i", $emailstr);
        }

        return $emailok;
    }
?>