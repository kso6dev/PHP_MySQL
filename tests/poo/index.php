<?php
// Chargement de la classe
require_once("House.php");

// Instanciation d'un objet
$mikesHouse = new House();
// Instanciation d'un autre objet
$julysHouse = new House();

$mikesHouse->openDoor();
$mikesHouse->closeDoor();
$mikesHouse->changeTemperature(21);
$julysHouse->changeTemperature(55); 