<?php

class BDDWriter implements SplObserver
{
  protected $db;
  
  public function __construct(PDO $db)
  {
    $this->db = $db;
  }
  
  public function update(SplSubject $obj)
  {
    $q = $this->db->prepare('INSERT INTO error_mgt SET error_msg = :err');
    $q->bindValue(':err', $obj->getFormatedError());
    $q->execute();
  }
}