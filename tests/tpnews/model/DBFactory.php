<?php

class DBFactory
{
    public static function getMysqlConnectionWithPDO()
    {
        $db = new PDO('mysql:host=localhost;dbname=test_ocr;charset=utf8', 'root', '');
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    }

    public static function getMysqlConnectionWithMySQLi()
    {
        return new mysqli('localhost', 'root', '', 'article');
    }
}