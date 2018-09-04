<?php
/**
 * @version 1.0
 * annotations utilisant la syntaxe docblock
 */
namespace controller;

class Magician extends Personage
{
    protected $_mag; //magic
    public function mag()
    {
        return $this->_mag;
    }
    public function setMag($mag)
    {
        $this->_mag = $mag;
    }

    public function addXp($xp) //override parent method
    {
        parent::addXp($xp); //call parent method
        $this->setMag($this->mag() + 1);
    }

    public function display()
    {
        parent::display();
        echo 'Mag: ' . $this->mag() . '<br>';
    }
}