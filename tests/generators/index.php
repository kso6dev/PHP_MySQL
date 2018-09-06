<?php

function autoload($classname)
{
    if (file_exists($file = $classname . '.php'))
    {
        require $file;
    }
}
spl_autoload_register('autoload');

echo '<h1>Generateurs</h1>';

echo 'avec la commande suivante on peut charger les lignes dun fichier dans une array: <br>';
echo '$lines = file(\'myfile\');<br>mais si le fichier est énorme ça craint. on va donc créer une classe qui implement Iterator<br>';

//utilisation standard
/*
$lines = file('linkfiles.sh');
foreach($lines as $line)
{
    echo $line, '<br>';
}
*/

echo '<h2>l\'utilisation de notre classe iterateur FileReader est la même et donne le même résultat</h2>';

//utilisation de notre classe iterateur FileReader
/*
$lines = new FileReader('linkfiles.sh');
foreach($lines as $line)
{
    echo $line, '<br>';
}
*/

echo '<p>Mais la création de la classe Iterateur demande pas mal de code, c\'est la qu\'interviennent les générateurs</p>';
echo '<p>Toute fonction qui contient le mot clé <strong>yield</strong> est un générateur. La fonction retourne alors une instance de la classe Generator.</p>';
echo '<p>La classe Generator implémente la classe Iterator</p>';

function readLines($fileName)
{
    //si pas de fichier on sort
    if (!$file = fopen($fileName, 'r'))
    {
        return;
    }

    //tant qu'il reste des lignes à parcourir
    while (($line = fgets($file)) != false)
    {
        //on dit à php que cette ligne du fichier fait office de "prochaine entrée du tableau"
        yield $line; 
    }
    fclose($file);
}
var_dump(readLines('linkfiles.sh'));
/*
$generator = readLines('linkfiles.sh');
foreach ($generator as $line)
{
    echo $line, '<br>';
}
*/

echo '<br>';
echo '<p>en fait, la fonction utilisée comme générateur ne sera exécutée que lors du foreach, et son exécution s\'arrêtera à chaque yield rencontré</p>';
echo '<p>Le yield indique à la boucle que la variable qui le suit est la prochaine valeur du générateur/itérateur</p>';
echo '<p>à chaque tour de boucle, PHP reprend la boucle là où il s\'était arrêté et continue jusqu\'au prochain yield, et ainsi de suite</p>';
echo '<p>un générateur étant un itérateur, il possède des clés. PHP incrémente le n° de clé à chaque yield. On peut ensuite le récupérer comme pour un iterateur</p>';
echo '<p>foreach (generator() as $key => $val) fournit la clé et la valeur associée</p>';
function generator()
{
    for ($i = 0; $i < 5; $i++)
    {
        yield 'itération n°' . $i;
    }
}
foreach (generator() as $key => $val)
{
    echo $key, '=>', $val, '<br>';
}
echo '<p>on peut modifier la valeur de la clé en utilisant la syntaxe yield $key => $val</p>';
echo '<p>donc yield \'a\' => 54 nous donnera pour la clé a la valeur 54</p>';
function keygenerator()
{
    for ($i = 0; $i < 5; $i++)
    {
        if ($i == 0)
        {
            yield 'a' => 54;
        }
        else
        {
            yield 'otherkey'.$i => 33 + $i - 7 * $i + $i - 1;
        }
    }
}
foreach (keygenerator() as $key => $val)
{
    echo $key, '=>', $val, '<br>';
}

echo '<p>on peut déclarer notre function generator dans une class et utiliser & pour dire que les valeurs qu\'elle renvoie seront passées par ref</p>';
echo '<p>de cette manière on pourra les modifier</p>';
echo '<p>public function $generator() dans la classe, qui yield par exemple chaque valeur d\'un attribut array</p>';
echo '<p>il faut aussi retourner les valeurs par ref donc foreach ($this->attribute as &$val) yield $val;</p>';
echo '<p>puis on l\'appelle ensuite: $myObj = new $MyClassWithGenerator();</p>';
echo '<p>foreach ($myObj->generator() as &$attr)</p>';
$objWithGen = new SimpleGeneratorClass();
foreach ($objWithGen->generator() as &$attr)
{
    echo 'ancienne valeur attribut ' . $attr. ' qu\'on uppercase<br>';
    $attr = strtoupper($attr);
}
foreach ($objWithGen->generator() as $attr)
{
    echo 'nouvelle valeur attribut = ' . $attr. '<br>';
}

echo '<p>on peut aussi envoyer des données au générateur grâce à la méthode send de la classe Generator</p>';
function receiverGenerator()
{
    echo yield;
}
$receivergen = receiverGenerator();
$receivergen->send('ceci est une donnée envoyée vers mon générateur<br>');

echo '<p><strong>attention:</strong><p>';
echo '<p>Le yield n\'est pas utilisé dans une expression : pas de parenthèses => yield \'Hello world !\';</p>';
echo '<p>Le yield est ici utilisé dans une expression, mais il est utilisé seul : pas de parenthèses => $data = yield;</p>';
echo '<p>Le yield est ici utilisé dans une expression : les parenthèses sont requises => $data = (yield \'Hello world !\');</p>';


function newrecgen()
{
    echo (yield 'hello world');
    echo yield;    
}
$nrgen = newrecgen();
// On envoie « Message 1 »
// PHP va donc l'afficher grâce au premier echo du générateur
$nrgen->send('Message 1');
// On envoie « Message 2 »
// PHP reprend l'exécution du générateur et affiche le message grâce au 2ème echo
$nrgen->send('Message 2');
// On envoie « Message 3 »
// La fonction générateur s’était déjà terminée, donc rien ne se passe
$nrgen->send('Message 3');

echo '<p>un générateur qui reçoit une valeur est un <strong>générateur inverse</strong> ou <strong>coroutine</strong></p>';
echo '<p>voir <a href="../multitasksgen">multitasksgen</a></p>';

echo '<p>avec la méthode throw, on peut envoyer une exception au moment du yield: $generator->throw(new Exception(\'Test\'));</p>';
function exgenerator()
{
    echo '<p>Début</p>';
    try
    {
        yield;
    }  
    catch (Exception $e)
    {
        echo '<p>on a intercepté une erreur au niveau du yield: ', $e->getMessage(), '</p>';
    }
    echo '<p>Fin</p>';
}
$exgen = exgenerator();
$exgen->throw(new Exception('erreur avant fin'));

echo '<br>fin';