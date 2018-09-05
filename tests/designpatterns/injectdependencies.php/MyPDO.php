<?php

class MyPDO extends PDO implements iDB
{
    public function query($query)
    {
        return new MyPDOStatement(parent::query($query));
    }
}