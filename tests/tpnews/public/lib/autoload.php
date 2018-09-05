<?php

function autoload($classname)
{

    $modelpath = substr(__DIR__, 0, strrpos(__DIR__, DIRECTORY_SEPARATOR)); //on remonte de 1 dossier
    $modelpath = substr($modelpath, 0, strrpos($modelpath, DIRECTORY_SEPARATOR)); //on remonte de 1 dossier
    $controllerpath = $modelpath;
    $modelpath = $modelpath . DIRECTORY_SEPARATOR . 'model';
    $controllerpath = $controllerpath . DIRECTORY_SEPARATOR . 'controller';

    if (file_exists($file = $modelpath . DIRECTORY_SEPARATOR . $classname . '.php'))
    {
        require $file;
    }

    if (file_exists($file = $controllerpath . DIRECTORY_SEPARATOR . $classname . '.php'))
    {
        require $file;
    }
}

spl_autoload_register('autoload');