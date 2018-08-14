<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Superglobales</title>
    </head>
    <body>
        <h1>Superglobales</h1>
        <p>
            <?php
                echo 'print_r($_GET) = '.print_r($_GET).'<br>';
                echo 'print_r($_POST) = '.print_r($_POST).'<br>';
                echo 'print_r($_COOKIE) = '.print_r($_COOKIE).'<br>';
                echo 'print_r($_ENV) = '.print_r($_ENV).'<br>';
                echo 'print_r($_FILES) = '.print_r($_FILES).'<br>';
                echo 'print_r($_REQUEST) = '.print_r($_REQUEST).'<br>';
                echo 'print_r($_SERVER) ='.print_r($_SERVER).'<br>';
                echo 'print_r($_SESSION) ='.print_r($_SESSION).'<br>';
            ?>
        </p>
    </body>
</html>