<?php

/**
 * Le but de ce design pattern est de séparer les algo utilisés, 
 * par exemple ici nous allons faire des Writers capables d'écrire dans différents formats
 * nous avons donc un Writer pour écrire un fichier, un autre pour écrire en BDD, les 2 héritent d'un Writer commun
 * ce Writer commun contient un Formater qui est une classe implémentant l'interface Formater pour obliger à implémenter la méthode format
 * on a ensuite 3 Formater possibles = 3 classes qui implémentent format: TextFormater, XMLFormater et HTMLFormater
 * De cette manière, il est très facile de modifier le fonctionnement d'une ou toutes les parties
 */

function autoload($class)
{
  if (file_exists($path = $class . '.php'))
    {
        require $path;
    }
}
spl_autoload_register('autoload');

echo '<h1>Pattern Strategy</h1>';

$writer = new FileWriter(new HTMLFormater, 'file.html');
$writer->write('Hello world !');
$writer = new FileWriter(new TextFormater, 'file.txt');
$writer->write('Hello world !');
$writer = new FileWriter(new XMLFormater, 'file.xml');
$writer->write('Hello world !');

echo '<br>fin';