<?php

namespace controller;

class Mailer
{
    use HTMLFormater, TextFormater
    {
        HTMLFormater::format insteadof TextFormater;
    }

    public function send($text)
    {
        mail('boulben68@hotmail.fr', 'Test with traits', $this->format($text));
    }
}