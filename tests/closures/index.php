<?php

echo '<h1>Closures</h1>';

$closureObj = function()
{
    echo '<p>Une closure est une fonction sans nom. En fait, c\'est un objet et plus exactement une instance de la clase <strong>Closure</strong></p>';

};
$closureObj();//grâce à la méthode __invoke()
var_dump($closureObj);

echo '<p>les closures sont principalement utilisées en tant que fonctions de rappels. Ce sont des fonctions demandées par d\'autres fonctions pour 
         effectuer des tâches spécifiques</p>';


$additionneur = function($nbr)
{
    return $nbr + 5;
};
$nbrList = [1, 2, 3, 4, 5];
$nbrList = array_map($additionneur, $nbrList);//array_map permet d'exécuter une fonction pour chaque membre d'une array, la fonction doit prendre en paramètre le membre
//=> on obtient $nbrList = [6, 7, 8, 9, 10]

$param = 3;
//avec use on peut utiliser une var externe à la closure, au sein même de cette closure
$add2 = function($nbr) use ($param) 
{
    return $nbr + $param;
};
//mais la var n'est pas dynamique, en gros on use 3 tout le temps car le use prend la valeur de la var used au moment de la déclaration de la closure
//on peut s'en sortir en définissant une closure dans une fonction
function createAdd($qty)
{
    return function($nbr) use($qty)
    {
        return $nbr + $qty;
    };
}
$nbrList = array_map(createAdd(3), $nbrList);
var_dump($nbrList);
$nbrList = array_map(createAdd(5), $nbrList);
var_dump($nbrList);

//on peut lier une closure à un objet pour qu'elle accède à ses attributs, et ce grâce à la méthode bindTo de la classe Closure
echo "<p>on peut lier une closure à un objet pour qu'elle accède à ses attributs, et ce grâce à la méthode bindTo de la classe Closure</p>";
$addattr = function()
{
    $this->_nbr += 5;
};
class MyClass
{
    private $_nbr = 0;

    public function nbr()
    {
        return $this->_nbr;
    }
}
$obj = new MyClass();

echo '<p>$addattr = $addattr->bindTo($obj, \'MyClass\');</p>';
$addattr = $addattr->bindTo($obj, 'MyClass');
echo '<p>echo $obj->nbr(); = ';
echo $obj->nbr();
echo '</p>';
echo '<p>$addattr()...</p>';
$addattr();
echo '<p>echo $obj->nbr(); = ';
echo $obj->nbr();
echo '</p>';


echo '<br>fin';