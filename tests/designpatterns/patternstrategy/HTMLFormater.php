<?php

class HTMLFormater implements Formater
{
    public function format($text)
    {
        return '<p>Date : ' . time() . '<br />' ."\n". 'Texte : ' . $text . '</p>';
    }
}