<?php

class Observer1 implements SplObserver
{
    public function update(SplSubject $obj)
    {
        echo '<br>Observer1 a été notifié. Nouvelle valeur attribut <strong>name</strong> = ' . $obj->getName();
    }
}