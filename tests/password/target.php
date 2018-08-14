<?php

    if (!isset($_POST["password"]) OR ($_POST["password"] != "kangourou"))
    {

    }
    else
    {
        ?>
        <!DOCTYPE html>
        <html>
            <head>
                <meta charset="utf-8">
            </head>
            <body>
                <h1>Bienvenu, vous avez tapé le bon mdp</h1>
            </body>
        </html>
        <?php
    }
?>
