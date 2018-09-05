<?php

class TextFormater implements Formater
{
    public function format($text)
    {
        return 'Date : ' . time() . "\n" . 'Texte : ' . $text;
    }
}