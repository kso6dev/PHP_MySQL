<?php

class MySingleton
{
    protected static $instance; // Contiendra l'instance de notre classe.
  
    protected function __construct() { } // Constructeur en privé.
  
    protected function __clone() { } // Méthode de clonage en privé aussi.
  
    public static function getInstance()
    {
        if (!isset(self::$instance)) // Si on n'a pas encore instancié notre classe.
        {
            self::$instance = new self; // On s'instancie nous-mêmes. :)
        }   
        return self::$instance;
    }

    public function display()
    {
        echo 'je suis une classe qu\'on ne peut instancier qu\'une seule fois!';
    }
}