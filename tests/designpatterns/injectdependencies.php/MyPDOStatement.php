<?php

class MyPDOStatement implements iResult
{
    protected $st;

    public function __construct(PDOStatement $st)
    {
        $this->st = $st;
    }

    public function fetchAssoc()
    {
        return $this->st->fetch(PDO::FETCH_ASSOC);
    }
}