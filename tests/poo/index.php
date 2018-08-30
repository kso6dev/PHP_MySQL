<?php
// Chargement de la classe
//require_once("House.php");

use \controller\Appartment;
use \model\PersonageManager;
use \controller\House;
use \controller\Logement;
use \controller\Personage;

//créer une fonction qui se charge de charger les classes souhaitées

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
//$hero = new Personage(10,10);

$hero = new Personage();
$hero->set(2, 'ben', 10, 10, Personage::DEFAULT_ATK, Personage::DEFAULT_ESC, 10, 10);
//call static method works from class AND obj
$hero->speak('je suis un hero');
Personage::speak('je suis un personnage non défini');
Personage::speakdef();
$ennemy = new Personage();
$ennemy->set(3, 'kaiser', 10, 10, Personage::DEFAULT_ATK, Personage::DEFAULT_ESC, 10, 10);
Personage::speakdef();

// Instanciation d'un objet
$mikesHouse = new House();
// Instanciation d'un autre objet
$julysHouse = new House();

$mikesHouse->openDoor();
$mikesHouse->closeDoor();
$mikesHouse->changeTemperature(21);
$julysHouse->changeTemperature(55); 

echo $hero->atk();

echo '<br>';

$filler = new PersonageManager();
$newhero = $filler->get(1);
if ($newhero != null)
{
    $newhero->display();
}

$filler->deleteAll();

$filler->add($hero);
$filler->add($ennemy);

$persos = $filler->getList();
foreach ($persos as $perso)
{
    $perso->display();
}
$hero->setName('hero');
$hero->setXp(15);
$hero->setHp(100);
$ennemy->setName('ennemy');
$ennemy->setStr('18');
$filler->update($hero);
$filler->update($ennemy);

$persos = $filler->getList();
foreach ($persos as $perso)
{
    $perso->display();
}

if ($newhero != null)
{
    $filler->delete($newhero);
}

$persos = $filler->getList();
foreach ($persos as $perso)
{
    $perso->display();
}

echo $filler->exists(1);
echo $filler->count();
