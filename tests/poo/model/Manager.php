<?php

class Manager
{
    protected $_db;

    protected function connectDB()
    {
        try
        {
            $this->_db = new PDO('mysql:host=localhost;dbname=RPG;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));//to get sql queries better errors
        }
        catch (Exception $e)
        {
            $errorMessage = $e->getMessage();
            require('view/errorView.php');
        }
    }
}