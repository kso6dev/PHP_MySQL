<?php
//UTILISATION DE L'API DE REFLEXIVITE

use \controller\Magician;

function chargeClass($className)
{
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
spl_autoload_register('chargeClass'); 



$magicianClass = new ReflectionClass('\controller\Magician');

$mago = new Magician();
$magoClass = new ReflectionObject($mago);

echo '<h1>UTILISATION DE L\'API DE REFLEXIVITE</h1>';

if ($magicianClass->hasProperty('_mag'))
{
    echo '$magicianClass->hasProperty(\'_mag\') est vrai <br>';
}
if ($magicianClass->hasConstant('DEFAULT_DEF'))
{
    echo '$magicianClass->hasConstant(\'DEFAULT_DEF\') est vrai <br>';
    echo '$magicianClass->getConstant(\'DEFAULT_DEF\') = ' . $magicianClass->getConstant('DEFAULT_DEF') . '<br>';
    echo '$magicianClass->getConstants() renvoie: ';
    echo '<pre>' , print_r($magicianClass->getConstants(), true) , '</pre>';
    echo '<br>';
}
if ($parentClass = $magicianClass->getParentClass())
{
    echo '$magicianClass->getParentClass() renvoie la classe parent sinon faux. <br>';
    echo '$parentClass->getName() renvoie le nom de la classe, ici : ' . $parentClass->getName();
    echo '<br>';
}
if ($magicianClass->isSubclassOf($parentClass))
{
    echo '$magicianClass->isSubclassOf($parentClass) renvoie vrai <br>';
}
echo '$parentClass->isFinal() renvoie ' . $parentClass->isFinal() . ' et $parentClass->isAbstract() renvoie ' . $parentClass->isAbstract() . '<br>';
echo '$parentClass->isInstantiable() renvoie ' . $parentClass->isInstantiable() . ' et $magicianClass->isInstantiable() renvoie ' . $magicianClass->isInstantiable() . '<br>';

$classiMovable = new ReflectionClass('\controller\iMovable');
if ($classiMovable->isInterface())
{
    echo '$classiMovable->isInterface() est vrai<br>';
}
if ($magicianClass->implementsInterface('\controller\iMovable'))
{
    echo '$magicianClass->implementsInterface(\'\\controller\\iMovable\') est vrai! <br>';
    echo '$magicianClass->getInterfaceNames() renvoi: <br>';
    echo '<pre>', print_r($magicianClass->getInterfaceNames(),true), '</pre> <br>';
}

$magAttribute = new ReflectionProperty('\controller\Magician', '_mag');
$magAttr = $magicianClass->getProperty('_mag');
echo $magAttribute->getName();
echo '<br>';
echo $magAttr->getName();

echo '$magicianClass->getProperties() renvoie <pre>', print_r($magicianClass->getProperties(), true), '</pre> <br>';
foreach($magicianClass->getProperties() as $attr)
{
    if ($attr->isPrivate() OR $attr->isProtected())
    {
        $attr->setAccessible(true);
    }
    echo 'attr ' . $attr->getName() . ' value = ' . $attr->getValue($mago) . '<br>';
}

$method = new ReflectionMethod('\controller\Magician', 'setMag');
$method2 = $magicianClass->getMethod('setMag');
if ($method2->isConstructor())
{
    echo 'bah non elle est pas constructor donc on affichera pas ce message pourri';
}

$method->invoke($mago, '10');
echo '$method->invoke($mago, \'10\') permet d\'executer la méthode qu\'on a chopé au préalable avec $magicialClass->getMethod(\'setMag\') <br>';
$method->invokeArgs($mago, ['10']);//needs an array for args


echo '<br>fin';
