<?php

/**
 * Le but de ce design pattern est d'utiliser des méthodes statiques de classes pour instancier des classes
 * On n'utilise donc jamais new ailleurs que dans ces méthodes statiques
 */
require_once('ClassFactory.php');
require_once('PDOFactory.php');

echo '<h1>Pattern Factory</h1>';

try
{
    $lambda = ClassFactory::load('Lambda');
    $lambda->display();
}
catch (RuntimeException $e)
{
    echo $e->getMessage();
}

$bd = PDOFactory::getMysqlConnexion();

echo '<br>fin';