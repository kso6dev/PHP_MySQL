<?php
//UTILISATION DE LA LIBRARY ANNOTAION
require 'public/addendum/annotations.php';

require 'controller/iMovable.php';
require 'controller/Personage.php';
require 'controller/MyAnnotations.php';


echo '<h1>UTILISATION DE LA LIBRARY ANNOTAION</h1>';

$reflectedClass = new ReflectionAnnotatedClass('Personage');
echo 'La valeur de l\'annotation <strong>Table</strong> est <strong>', $reflectedClass->getAnnotation('Table')->value, '</strong><br>';
echo 'La valeur de l\'annotation <strong>Type</strong> est <strong> <pre>', print_r($reflectedClass->getAnnotation('Type')->value, true), '</pre></strong><br>';

$annot = 'Test';
if ($reflectedClass->hasAnnotation($annot))
{
    echo 'La classe possède une annotation <strong>', $annot, '</strong> dont la valeur est <strong>', $reflectedClass->getAnnotation($annot)->value, '</strong><br />';
}

$classInfos = $reflectedClass->getAnnotation('ClassInfos');
echo '$classInfos->author = ', $classInfos->author, ' and $classInfos->version = ', $classInfos->version, '<br>';

$reflectedAttr = new ReflectionAnnotatedProperty('Personage', '_type');
$reflectedMethod = new ReflectionAnnotatedMethod('Personage', 'set');
echo 'Infos concernant l\'attribut :';
echo '<pre>', print_r($reflectedAttr->getAnnotation('AttrInfos'),true), '</pre><br>';

echo 'Infos concernant la méthode :';
echo '<pre>', print_r($reflectedMethod->getAnnotation('MethodInfos'),true), '</pre><br>';


echo 'Infos concernant les paramètres de la méthode :';
echo '<pre>', print_r($reflectedMethod->getAllAnnotations('ParamInfo'),true), '</pre><br>';
echo '<br>fin';
