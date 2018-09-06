<?php

class FileReader implements Iterator
{
    protected $file;

    protected $currentLine;
    protected $currentKey;

    public function __construct($file)
    {
        if (!$this->file = fopen($file, 'r'))
        {
            throw new RuntimeException('Impossible d\'ouvrir le fichier "' . $file . '"');
        }
    }

    //function to go to first line
    public function rewind()
    {
        fseek($this->file, 0);
        $this->currentLine = fgets($this->file);
        $this->currentKey = 0;
    }

    //check that current line exists
    public function valid()
    {
        return $this->currentLine !== false;
    }

    //return current line
    public function current()
    {
        return $this->currentLine;
    }

    //return current key
    public function key()
    {
        return $this->currentKey;
    }

    //déplace curseur sur la ligne suivante
    public function next()
    {
        if ($this->valid())
        {
            $this->currentLine = fgets($this->file);
            $this->currentKey++;
        }
    }
}