<?php
use \controller\Appartment;
use \model\PersonageManager;
use \controller\House;
use \controller\Logement;
use \controller\Personage;
use \controller\Magician;
use \controller\Barbarian;
use \model\Connexion;

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
spl_autoload_register('chargeClass'); //la fonction sera donc appelée dès qu'on instanciera une classe non déclarée

session_start();

$hero = new Magician();
$hero->set(1, 'Gandalf', 10, 10, Personage::DEFAULT_ATK, Personage::DEFAULT_ESC, 10, 10);
$hero->setMag(100);
//call static method works from class AND obj
$hero->speak('je suis un hero');
Personage::speak('je suis un personnage non défini');
Personage::speakdef();
$ennemy = new Barbarian();
$ennemy->set(2, 'Grougal', 10, 10, Personage::DEFAULT_ATK, Personage::DEFAULT_ESC, 10, 10, 50);
$ennemy->setRage(1000);
Personage::speakdef();
$ennemy->display();

// Instanciation d'un objet
$mikesHouse = new House();
// Instanciation d'un autre objet
$julysHouse = new House();

$mikesHouse->openDoor();
$mikesHouse->closeDoor();
$mikesHouse->changeTemperature(21);
$julysHouse->changeTemperature(55); 

$filler = new PersonageManager();
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

echo $filler->exists(1);
echo $filler->count();

$mago = new Magician();
$mago->set(3, 'Harry', 1, 100, 10, 10, 10, 10);
$mago->setMag(10);
$mago->display();

$mago->power = 150;
echo $mago->power;
echo 'Attribut power= ' . $mago->getNewAttribute('power') . '. <br>';

$mago->doSomething();//devrait déclencher une erreur mais comme on a définit la function __call et qu'elle est vide, il n'y a pas d'erreur!

echo serialize($mago);

$serialArr = '';
$arr = array (1, 4, 5, 8, 12);
$serialArr = serialize($arr);
echo '<br> voici une array simple serialisée: ' . $serialArr;
echo '<br> et la voici déserialisée: <pre>';
print_r(unserialize(($serialArr)));
echo '<pre>';

$arr = array ('x'=>1, 'y'=>4, 'str'=>5, 'hp'=>8, 'rage'=>12);
$serialArr = serialize($arr);
echo '<br> voici une array nommée serialisée: ' . $serialArr;
echo '<br> et la voici déserialisée: <pre>';
print_r(unserialize(($serialArr)));
echo '<pre>';

/*
$fh = fopen('test.txt', 'a+');//ouverture/création d'un fichier s'il n'existe pas
fwrite($fh, $serialArr);//on écrit
fwrite($fh, urlencode($serialArr));//on écrit en encodant pour que ça passe dans une url
fclose($fh);//on ferme
*/

$connexion = new Connexion('localhost', 'root', '', 'RPG');

echo '<br>';
$_SESSION['mago'] = $mago;
$_SESSION['connexion'] = $connexion; 
echo '<a href="pageresult.php" title="go to pageresult session">Go to pageresult and keep obj using session</a>';
echo '<br>';
echo '<a href="pageresult.php?mago=' . urlencode(serialize($mago)) . '" title="go to pageresult url">Go to pageresult and keep obj in url</a>';