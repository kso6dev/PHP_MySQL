<?php

/**
 * Le but de ce design pattern est d'observer ses objets pour alerter les autres objets quand un est utilisé/modifié
 * On utilise la library standard SPL et plus particulièrement les interfaces SplObserver et SplSubject
 *
 */

require_once('Observed.php');
require_once('Observer1.php');
require_once('Observer2.php');
require_once('ErrorHandler.php');
require_once('BDDWriter.php');
require_once('MailSender.php');
require_once('PDOFactory.php');

echo '<h1>Pattern Observer</h1>';

$o = new Observed();

$o->attach(new Observer1);
$o->attach(new Observer2);

$o->setName('Kaiser');
$o->setName('sosejik');


//ERROR HANDLER
$e = new ErrorHandler; // Nous créons un nouveau gestionnaire d'erreur.
$db = PDOFactory::getMysqlConnexion();

$e->attach(new MailSender('boulben68@hotmail.fr'));
$e->attach(new BDDWriter($db));

set_error_handler([$e, 'error']); // Ce sera par la méthode error() de la classe ErrorHandler que les erreurs doivent être traitées.

5 / 0; // Générons une erreur

echo '<br>fin';