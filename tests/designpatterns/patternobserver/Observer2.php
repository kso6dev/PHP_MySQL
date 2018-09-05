<?php

class Observer2 implements SplObserver
{
    public function update(SplSubject $obj)
    {
        echo '<br>Observer2 a été notifié. Nouvelle valeur attribut <strong>name</strong> = ' . $obj->getName();
    }
}