<?php

namespace controller;

trait TextFormater
{
    public function format($text)
    {
        return 'Date : ' . date('d/m/Y') . "\n" . $text;
    }
}