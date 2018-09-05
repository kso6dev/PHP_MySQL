<?php

class MyMySQLiResult implements iResult
{
    protected $st;

    public function __construct(mysqli_result $st)
    {
        $this->st = $st;
    }

    public function fetchAssoc()
    {
        return $this->st->fetch_assoc();
    }
}