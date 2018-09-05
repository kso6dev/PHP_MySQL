<?php

class Observed implements SplSubject
{
    // Ceci est le tableau qui va contenir tous les objets qui nous observent.
    protected $observers = [];

    // Dès que cet attribut changera on notifiera les classes observatrices.
    protected $name;

    public function attach(SplObserver $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(SplObserver $observer)
    {
        if (is_int($key = array_search($observer, $this->observers, true)))
        {
            unset($this->observers[$key]);
        }
    }

    public function notify()
    {
        foreach ($this->observers as $observer)
        {
            $observer->update($this);
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
        $this->notify();
    }
}