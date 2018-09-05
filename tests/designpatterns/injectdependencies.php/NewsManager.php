<?php

class NewsManager
{
    protected $dao;

    // On souhaite un objet instanciant une classe qui implémente iDB.
    public function __construct(iDB $dao)
    {
        $this->dao = $dao;
    }

    public function get($id)
    {
        $q = $this->dao->query('SELECT id, title, content FROM news WHERE id = '.(int)$id);
        // On vérifie que le résultat implémente bien iResult.
        if (!$q instanceof iResult)
        {
            throw new Exception('Le résultat d\'une requête doit être un objet implémentant iResult');
        }
        return $q->fetchAssoc();
    }
}