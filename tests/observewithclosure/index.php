<?php

require_once('Observed.php');
require_once('Observer.php');

echo '<h1>Pattern Observer with closure</h1>';

$o = new Observed();
$observer1 = function(SplSubject $subject)
{
    echo $this->getName(), 'a été notifié. nouvelle valeur de name : ', $subject->getName(), '<br>';
};

$observer2 = function(SplSubject $subject)
{
    echo $this->getName(), 'a été notifié. nouvelle valeur de name : ', $subject->getName(), '<br>';
};

//ici on va envoyer à notre objet observé 2 instances de la classe Observer, ces 2 instances étant représentées par 2 obj closures différents
//donc 2 instances de closures qu'il est important de nommer différemment: Observer1 et Observer2!
$o->attach(new Observer($observer1, 'Observer1'));
$o->attach(new Observer($observer2, 'Observer2'));

$o->setName('Kaiser');
$o->setName('sosejik');

echo '<br>fin';