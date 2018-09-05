<?php

class MyMySQLi extends MySQLi implements iDB
{
    public function query($query, $resultmode = NULL)
    {
        return new MyMySQLiResult(parent::query($query));
    }
}