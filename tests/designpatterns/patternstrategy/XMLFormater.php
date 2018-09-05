<?php

class XMLFormater implements Formater
{
    public function format($text)
    {
        return '<?xml version="1.0" encoding="ISO-8859-1"?>' ."\n".
           '<message>' ."\n".
           "\t". '<date>' . time() . '</date>' ."\n".
           "\t". '<texte>' . $text . '</texte>' ."\n".
           '</message>';
    }
}