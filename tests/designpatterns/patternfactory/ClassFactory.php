<?php

class ClassFactory
{
    public static function load($classname)
    {
        if (file_exists($path = $classname . '.php'))
        {
            require $path;
            return new $classname;
        }
        else
        {
            throw new RuntimeException('La classe <strong>' . $classname . '</strong> n\'a pu être trouvée!');
        }
    }
}