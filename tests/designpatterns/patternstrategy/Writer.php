<?php

abstract class Writer
{
    //attribut contenant l'instance du formater que l'on veut utiliser
    protected $formater;

    abstract public function write($text);

    //nous voulons une instance d'une classe implémentant Formater en paramètre
    public function __construct(Formater $formater)
    {
        $this->formater = $formater;
    }
}