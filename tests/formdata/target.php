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
                if (!isset($_POST["firstname"]) OR !isset($_POST["country"]) OR !isset($_POST["aboutyou"]))
                {
                    echo "oups il y a un pblm";
                }
                else
                {
                    echo 'Hello '.$_POST["firstname"].' ! <br>';
                    echo '"'.$_POST["aboutyou"].'", rien de plus à ajouter?? <br>';
                    echo 'ah si, tu viens de '.htmlspecialchars($_POST["country"]).' ! <br>';
                    
                    if (isset($_POST["xboxcheck"]))
                    {
                        echo 'Je vois que tu as une xbox! <br>';    
                    }
                    if (isset($_POST["pscheck"]))
                    {
                        echo 'Je vois que tu as une ps4! <br>';    
                    }
                    if (isset($_POST["dscheck"]))
                    {
                        echo 'Je vois que tu as une DS! <br>';    
                    }
                }
                if (isset($_POST["sex"]))
                {
                    echo 'et donc ton type ce serait plutôt '.htmlspecialchars($_POST["sex"]).'? <br>';
                }
                echo 'j\'ai stocké mon pseudo au cas où: '.htmlspecialchars($_POST["pseudo"]).'. Mais il est en dur dans un champ hidden du form.. <br>';
                if (isset($_POST["protected"]))
                {
                    echo 'ah, et j\'ai protégé la page contre le XSS mais que pour le textarea 2, celui qui contient: '.htmlspecialchars($_POST["protected"]).'... <br>';
                    echo 'je peux aussi les afficher sans les balises: '.strip_tags($_POST["protected"]).'... <br>';
                }
                ?>
            </p>
        </div>
    </body>
</html>