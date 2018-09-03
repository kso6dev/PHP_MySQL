<?php

namespace model;
use PDO;

class Connexion
{
    protected $_pdo;
    protected $_server;
    protected $_user;
    protected $_pwd;
    protected $_dbname;

    public function __construct($server, $user, $pwd, $dbname)
    {
        $this->_server = $server;
        $this->_user = $user;
        $this->_pwd = $pwd;
        $this->_dbname = $dbname;

        $this->connectToDB();
    }

    public function __sleep()
    {
        // Ici sont à placer des instructions à exécuter juste avant la linéarisation.
        // On retourne ensuite la liste des attributs qu'on veut sauver. PDO est un objet qui ne peut être linéarisé
        return ['_server', '_user', '_pwd', '_dbname'];
    }
    
    public function __wakeup()
    {
        //cette fonction étant appelée après unserialize, on peut relancer direct la connexion à la database
        $this->connectToDB();
    }

    public function __toString()
    {
        return 'cet objet permet la connexion à la database';
    }

    public function __set_state($values)// Liste des attributs de l'objet en paramètre.
    {
        //appelée quand on exporte l'objet en code PHP grace à var_export(obj)
        $obj = new Export($values['_server'], $values['_user'], $values['_dbname']); // On crée un objet avec les attributs de l'objet que l'on veut exporter.
        return $obj; // on retourne l'objet créé.
    }

    public function __invoke($arg)
    {  
        //appelée quand on utilise l'objet comme une fonction..
        echo $arg;
    }
    
    public function __debugInfo()
    {
        //appelée quand on demande des infos sur un objet via la function var_dump
        //il faut retourner un tableau nominatif
        return ['available drivers' => PDO::getAvailableDrivers()];
    }

    protected function connectToDB()
    {
        try
        {
            $this->_db = new PDO('mysql:host=' . $this->_server . ';dbname=' . $this->_dbname . ';charset=utf8', 
                $this->_user, $this->_pwd, array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));//to get sql queries better errors
        }
        catch (PDOException $e) // On attrape les exceptions PDOException.
        {
            echo 'La connexion a échoué.<br />';
            echo 'Informations : [', $e->getCode(), '] ', $e->getMessage(); // On affiche le n° de l'erreur ainsi que le message.
        }        
        catch (Exception $e)
        {
            $errorMessage = $e->getMessage();
            require('view/errorView.php');
        }

    }
}