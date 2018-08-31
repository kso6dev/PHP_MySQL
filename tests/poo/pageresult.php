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

if (isset($_GET['mago']))
{
    $mago = unserialize(($_GET['mago']));
    echo 'notre objet mago a été transféré d\'une page à l\'autre via l\'url: <br>';
    echo serialize($mago); //notre objet mago a été transféré d'une page à l'autre grâce à la var de session:

}
else
if (isset($_SESSION['mago']))
{
    $mago = $_SESSION['mago'];
    echo 'notre objet mago a été transféré d\'une page à l\'autre grâce à la var de session: <br>';
    echo serialize($mago); //notre objet mago a été transféré d'une page à l'autre grâce à la var de session:
}

if (isset($_SESSION['connexion']))
{
    $connexion = $_SESSION['connexion'];
    echo '<br>';
    echo 'et on a même conservé les infos de connexion à la bdd dans la classe connexion linéarisée et stockée dans la session. risqué maybe???: <br>';
    echo serialize($connexion);
    echo '<br> pour info on a utilisé la méthode __sleep dans notre classe connexion pour ne pas transmettre l\'attribut pdo qui représente un objet 
    PDO qui ne peut pas être linéarisé';
    echo '<br> ET EN PLUS ON EST RECO DIRECT GRACE A LA METHODE __wakeup dans laquelle on rappel la méthode connectToDB de notre classe Connexion';
    echo '<br>';
    echo '<br>';
    echo 'la méthode __toString() permet de définir quel texte renvoyer quand on veut afficher un obj en txt. Pour l\'obj connexion, j\'ai défini :';
    echo '<br>';
    $txt = (string) $connexion; 
    echo $txt;
    echo '<br>';
    echo '<br>';

    $fh = fopen('test.txt', 'a+');//ouverture/création d'un fichier s'il n'existe pas
    fwrite($fh, var_export($connexion, true));//on écrit en code php l'objet dans un fichier txt!
    fclose($fh);//on ferme

    $connexion('et la méthode magique __invoke');

    echo '<br>';
    echo '<br>';
    var_dump($connexion);
}
