<?php

class SimpleGeneratorClass
{

    protected $attributes;

    public function __construct()
    {
        $this->attributes = ['un', 'deux', 'trois', 'quatre', 'cinq'];
    }

    public function &generator()
    {
        foreach ($this->attributes as &$attrval)
        {
            yield $attrval;
        }
    }
}