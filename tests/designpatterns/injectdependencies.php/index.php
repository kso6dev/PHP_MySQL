<?php

/**
 * Le but de ce design pattern est de rendre les classes les plus indépendantes possibles!
 * Pour une connexion par exemple on peut avoir besoin de PDO ou MySql
 * Pour éviter d'être dépendant de l'un ou l'autre on va utiliser des interfaces et classes propres à chacune 
 * pour au final ne pas les utiliser directement dans notre classe de connexion
 */

function autoload($class)
{
  if (file_exists($path = $class . '.php'))
    {
        require $path;
    }
}
spl_autoload_register('autoload');

echo '<h1>Pattern Injection de dépendances</h1>';

//Ici on peut utiliser PDO ou MySQL pour intéragir avec la bdd, sans que la classe Manager ne dépende de PDO ou MySQL!
$dao = new MyPDO('mysql:host=localhost;dbname=test_ocr', 'root', '');
//$dao = new MyMySQLi('localhost', 'root', '', 'test_ocr');
$manager = new NewsManager($dao);
print_r($manager->get(2));

echo '<br>fin';