<?php

use \controller\Game;
use \controller\displayer;
use \model\PersonageManager;

function chargeClass($className)
{
    //require_once('controller/'.$className.'.php');
    $className = ltrim($className, '\\');
    $fileName = '';
    $namespace = '';
    if ($lastNsPos = strrpos($className, '\\')) 
    {
        $namespace = substr($className, 0, $lastNsPos);
        $className = substr($className, $lastNsPos + 1);
        $fileName  = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
    }
    $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . '.php';

    require_once($fileName);
}

//on place cette fonction dans l'autoload register:
spl_autoload_register('chargeClass'); //la fonction sera donc appelée dès qu'on instanciera une classe non déclarée
if (!isset($game))
{
    $game = new Game();
    $game->initNew();
}

if (isset($_POST['create']) AND isset($_POST['name']))
{
    $game->newHeroCreated();
}

if (isset($_POST['choose']) AND isset($_POST['name']))
{
    $game->heroSelected();
}

require_once('controller/displayer.php');
display($game->state());