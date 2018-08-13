<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Hello</title>
    </head>

    <body>
        <div id="main_wrapper">
            <p>
                <?php
                if (isset($_GET["repeat"]))
                {
                    $_GET["repeat"] = (int) $_GET["repeat"];
                } 
                if (!isset($_GET["firstname"]) OR !isset($_GET["lastname"]) OR !isset($_GET["repeat"]) OR ($_GET["repeat"] > 20))
                {
                    echo "y a un problème avec les param faut pas trafiquer l'url merci" ;  
                }
                else
                {
                    for ($i = 0; $i < $_GET["repeat"]; $i++)
                    {
                        echo 'Hello '.$_GET["firstname"].' '.$_GET["lastname"].'! <br />';
                    }
                }
                ?>
            </p>
        </div>
    </body>
</html>