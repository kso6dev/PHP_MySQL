<?php

use \controller\Personage;

require_once('model/Manager.php');

class PersonageManager extends Manager
{

    public function get($id)
    {
        $this->connectDB();
        $perso = null;
        try
        {
            $query = $this->_db->prepare('SELECT id, name, xp, hp, atk, esc, str, def FROM Personage WHERE id=:id');
            $query->execute(array(
                'id' => $id
            ));// or die (print_r($db->errorInfo()));
            
            if ($rec = $query->fetch(PDO::FETCH_ASSOC))
            {
                //$perso = new Personage((int)$rec['id'], $rec['name'], (int)$rec['xp'], (int)$rec['hp'], 
                //                            (int)$rec['atk'], (int)$rec['esc'], (int)$rec['str'], (int)$rec['def']);
                $perso = new Personage();
                $perso->hydrate($rec);
            }

            $query->closeCursor();
        }
        catch (Exception $e)
        {
            $errorMessage = $e->getMessage();
            require('view/errorView.php');
        }
        return $perso;
    }

    public function getList()
    {
        $persos = [];
        $query = $this->_db->query('SELECT id, name, xp, hp, atk, esc, str, def FROM Personage');
        while ($rec = $query->fetch())
        {
            $perso = new Personage();
            $perso->hydrate($rec);
            $persos[] = $perso;
        }
        return $persos;
    }

    public function add(Personage $perso)
    {
        $query = $this->_db->prepare('INSERT INTO Personage(name, xp, hp, atk, esc, str, def) VALUES(:name, :xp, :hp, :atk, :esc, :str, :def)');
        $query->execute(array(
            'name' => $perso->name(),
            'xp' => $perso->xp(),
            'hp' => $perso->hp(),
            'atk' => $perso->atk(),
            'esc' => $perso->esc(),
            'str' => $perso->str(),
            'def' => $perso->def()
        ));
    }

    public function update(Personage $perso)
    {
        $query = $this->_db->prepare('UPDATE Personage SET name=:name, xp=:xp, hp=:hp, atk=:atk, esc=:esc, str=:str, def=:def WHERE id=:id');
        $query->execute(array(
            'id' => $perso->id(),
            'name' => $perso->name(),
            'xp' => $perso->xp(),
            'hp' => $perso->hp(),
            'atk' => $perso->atk(),
            'esc' => $perso->esc(),
            'str' => $perso->str(),
            'def' => $perso->def()
        ));
    }

    public function delete(Personage $perso)
    {
        $query = $this->_db->prepare('DELETE FROM Personage WHERE id=:id');
        $query->execute(array(
            'id' => $perso->id()
        ));
    }

    public function deleteAll()
    {
        $query = $this->_db->query('TRUNCATE TABLE Personage');
    }

    public function count()
    {
        $query = $this->_db->query('SELECT COUNT(*) as countperso FROM Personage');
        $rec = $query->fetch();
        return $rec['countperso'];
    }

    public function exists($criteria)
    {
        if (is_int($criteria))
        {
            $query = $this->_db->prepare('SELECT id FROM Personage WHERE id=:crit');
        }
        else
        {
            $query = $this->_db->prepare('SELECT id FROM Personage WHERE name=:crit');
        }
        $query->execute(array(
            'crit' => $criteria
        ));
        
        return (bool)($rec = $query->fetch());
    }
}