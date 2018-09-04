<?php
use \controller\Appartment;
use \model\PersonageManager;
use \controller\House;
use \controller\Logement;
use \controller\Personage;
use \controller\Magician;
use \controller\Barbarian;
use \model\Connexion;
use \controller\ClassOCR;
use \controller\MyException;
use \controller\MyErrorException;
use \controller\Mailer;

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

//ATTENTION : une var obj ne contient pas vraiment l''objet mais son id
// donc quand on créé une nouvelle var = var obj, la nouvelle var contient aussi son id donc c'est 2 fois la même instance
// pour copier un objet, il faut le cloner
$magosameid = $mago;
echo '<br> parcours objet avec foreach affichera rien car attributs privés :D <br>';
foreach($magosameid as $attribute => $value)
{
    echo $attribute . ' = ' . $value;
}
$magoclone = clone $mago;

//la constante d'une interface est accessible même depuis la classe fille d'une classe qui implémente l'interface
echo '<br> la constante d\'une interface est accessible même depuis la classe fille d\'une classe qui implémente l\'interface: <br>';
echo Magician::DEFAULT_SPEED;

echo '<h3> UTILISATION de 4 interfaces prédéfinies permettant d\'utiliser notre classe comme une array : </h3>';
echo '=> class ClassOCR implements SeekableIterator, ArrayAccess, Countable (SeekableIterator hériter de Seekable donc pas besoin d\'implementer Seekable';
echo '<br>';
echo 'MEME SI EN FAIT IL S\'uffit d\'hériter de la classe ArrayIterator qui implémente déjà ces interfaces..';
echo '<br>';
$objet = new ClassOCR;

echo 'Parcours de l\'objet...<br />';
foreach ($objet as $key => $value)
{
  echo $key, ' => ', $value, '<br />';
}

echo '<br />Remise du curseur en troisième position...<br />';
$objet->seek(2);
echo 'Élément courant : ', $objet->current(), '<br />';

echo '<br />Affichage du troisième élément : ', $objet[2], '<br />';
echo 'Modification du troisième élément... ';
$objet[2] = 'Hello world !';
echo 'Nouvelle valeur : ', $objet[2], '<br /><br />';

echo 'Actuellement, mon tableau comporte ', count($objet), ' entrées<br /><br />';

echo 'Destruction du quatrième élément...<br />';
unset($objet[3]);

if (isset($objet[3]))
{
  echo '$objet[3] existe toujours... Bizarre...';
}
else
{
  echo 'Tout se passe bien, $objet[3] n\'existe plus !';
}

echo '<br /><br />Maintenant, il n\'en comporte plus que ', count($objet), ' !';
echo '<br>';

//GESTION DES ERREURS
function additionner($a, $b)
{
  if (!is_numeric($a) || !is_numeric($b))
  {
    //throw new MyException('Les deux paramètres doivent être des nombres');
    throw new InvalidArgumentException('Les deux paramètres doivent être des nombres');
  }
  return $a + $b;
}

try // Nous allons essayer d'effectuer les instructions situées dans ce bloc.
{
  echo additionner(12, 3), '<br />';
  echo additionner('azerty', 54), '<br />';
  echo additionner(4, 8);
}
catch (MyErrorException $e)
{
    echo 'on attrape avec MyErrorException qui hérite de ErrorException et quon a renvoyé depuis un function qui se déclenche a chaque erreur';
}
catch (InvalidArgumentException $e)
{
    echo 'Une exception de type InvalidArgumentException a été lancée. Message d\'erreur : ', $e->getMessage();
}
catch (MyException $e) // Nous allons attraper les exceptions "MyException" s'il y en a une qui est levée.
{
    echo $e;//suffit car on a catch MyException qui hérite d'Exception mais dans laquelle on a réécrit __toString()
}
catch (Exception $e)// Nous allons attraper les exceptions "Exception" s'il y en a une qui est levée.
{
    echo 'Une exception a été lancée. Message d\'erreur : ', $e->getMessage();
}
finally
{
    echo '<br> finally: on exécute du code avant de déclencher une erreur pour par exemple fermer un fichier';
}
echo '<br>';
echo 'Fin du script'; // Ce message s'affiche, ça prouve bien que le script est exécuté jusqu'au bout.

//définition d'une fonction qui renvoie ma classe MyErrorException quand il y a une erreur 
function error2exception($code, $message, $fichier, $ligne)
{
    // Le code fait office de sévérité.
    // Reportez-vous aux constantes prédéfinies pour en savoir plus.
    // http://fr2.php.net/manual/fr/errorfunc.constants.php
    throw new MyErrorException($message, 0, $code, $fichier, $ligne);
}
//on fait en sorte que la fonction s'exécute quand il y a une erreur
set_error_handler('error2exception');
try
{
    throw new MyErrorException('oupsi');
}
catch (MyErrorException $e)
{
    echo '<br>on attrape avec MyErrorException qui hérite de ErrorException et quon a renvoyé depuis un function qui se déclenche a chaque erreur';
    echo '<br>';
    echo $e;
}

//définition d'une fonction qui intercepte les exceptions non catchés
function customexception($e)
{
    echo 'Ligne ', $e->getLine(), ' dans ', $e->getFile(), '<br /><strong>Exception lancée</strong> : ', $e->getMessage();
}
//il faut ensuite faire en sorte qu'elle s'exécute quand il y a une exception non catchée
set_exception_handler('customexception');

$m = new Mailer;
$m->send('Hello world!');