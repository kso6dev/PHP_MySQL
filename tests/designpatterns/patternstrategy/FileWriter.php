<?php

class FileWriter extends Writer
{
    //atribut stockant le chemin du fichier
    protected $file;

    public function __construct(Formater $formater, $file)
    {
        parent::__construct($formater);
        $this->file = $file;
    }

    public function write($text)
    {
        $f = fopen($this->file, 'w');
        fwrite($f, $this->formater->format($text));
        fclose($f);
    }
}