<?php

namespace controller;

trait HTMLFormater
{
    protected $_htmlformateratt = '</>';

    public function format($text)
    {
        return '<p>Date : ' . date('d/m/Y') . '</p>' . "\n" . '<p>' . nl2br($text) . '</p>';
    }
}