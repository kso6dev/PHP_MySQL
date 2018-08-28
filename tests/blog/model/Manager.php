<?php

namespace sosejik\tests\blog\model;

use PDO;

class Manager
{
    protected function connectDB()
    {
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=test_ocr;charset=utf8', 'root', '', array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));//to get sql queries better errors
        }
        catch (Exception $e)
        {
            $errorMessage = $e->getMessage();
            require('view/errorView.php');
        }
        return $bdd;
    }
}