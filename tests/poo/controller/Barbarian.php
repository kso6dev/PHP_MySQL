<?php

namespace controller;

class Barbarian extends Personage
{
    protected $_rage; //magic
    public function rage()
    {
        return $this->_rage;
    }
    public function setRage($rage)
    {
        $this->_rage = $rage;
    }

    public function addXp($xp) //override parent method
    {
        parent::addXp($xp); //call parent method
        $this->setRage($this->rage() + 1);
    }

    public function display()
    {
        parent::display();
        echo 'Rage: ' . $this->rage() . '<br>';
    }
}