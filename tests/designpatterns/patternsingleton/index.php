<?php

/**
 * Le but de ce design pattern est de ne permettre l'instanciation d'une classe qu'une fois!
 * Pour se faire, on instancie la classe au sein de la classe elle même et on va donc bloquer
 * le constructeur et le clonage en rendant les méthodes (__construct et __clone) protected
 * De plus, on stock l'instance dans un attribut static et on instancie via une méthode static uniquement si pas déjà fait
 */

function autoload($class)
{
  if (file_exists($path = $class . '.php'))
    {
        require $path;
    }
}
spl_autoload_register('autoload');

echo '<h1>Pattern Singleton</h1>';

$single = MySingleton::getInstance();
$single->display();

echo '<br>fin';