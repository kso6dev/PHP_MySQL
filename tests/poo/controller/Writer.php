<?php

namespace controller;

class Writer
{
    use HTMLFormater;

    public function write($text)
    {
        file_put_contents('file.txt', $this->format($text));
    }
}