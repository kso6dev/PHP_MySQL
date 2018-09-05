<?php

class DBWriter extends Writer
{

    protected $db;

    public function __construc(Formater $formater, PDO $db)
    {
        parent::__construct($formater);
        $this->db = $db;
    }

    public function write($text)
    {
        $q = $this->db->prepare('INSERT INTO error_mgt SET error_msg=:er');
        $q->execute(array(
            'er' => $text
        ));
        $q->closeCursor();
    }
}