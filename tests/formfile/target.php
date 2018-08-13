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
                    if (isset($_FILES["myfile"]) AND $_FILES["myfile"]["error"] == 0 AND $_FILES["myfile"]["size"] < 1000000)
                    {

                        $file = $_FILES["myfile"];
                        $fileinfo = pathinfo($file["name"]);
                        $fileext = $fileinfo["extension"];
                        $allowedext = array('jpg', 'txt', 'gif', 'png', 'md');
                        if (in_array($fileext, $allowedext))
                        {
                            echo 'nom: '.$file["name"].'. <br>';
                            echo 'type: '.$file["type"].'. <br>';
                            echo 'size: '.$file["size"].'. <br>';
                            echo 'tmp_name: '.$file["tmp_name"].'. <br>';
                            echo 'error code: '.$file["error"].'. <br>';

                            //on valide et on stocke définitivement le fichier
                            $destinationname = '/opt/lampp/htdocs/tests/formfile/uploads/'.basename($file["name"]);
                            move_uploaded_file($file["tmp_name"], $destinationname);
                            echo 'fichier reçu et sauvegardé sur le serveur dans '.$destinationname.'. <br>';
                        }
                        else
                        {
                            echo $fileext;
                        }
                        
                    }
                    else
                    {
                        echo 'oups';
                    }
                ?>
            </p>
        </div>
    </body>
</html>