<?php

namespace model;
use \controller\Magician;
use \controller\Personage;
use \controller\Barbarian;
use PDO;

class PersonageManager extends Manager
{
    public function get($id)
    {
        $perso = null;
        try
        {
            $query = $this->_db->prepare('SELECT id, name, xp, hp, atk, esc, str, def, type FROM Personage WHERE id=:id');
            $query->execute(array(
                'id' => $id
            ));// or die (print_r($db->errorInfo()));
            
            if ($rec = $query->fetch(PDO::FETCH_ASSOC))
            {
                //$perso = new Personage((int)$rec['id'], $rec['name'], (int)$rec['xp'], (int)$rec['hp'], 
                //                            (int)$rec['atk'], (int)$rec['esc'], (int)$rec['str'], (int)$rec['def']);
                if ($rec['type'] == 'Magician')
                {
                    $perso = new Magician();
                }
                if ($rec['type'] == 'Barbarian')
                {
                    $perso = new Barbarian();
                }
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
        $query = $this->_db->query('SELECT id, name, xp, hp, atk, esc, str, def, type FROM Personage');
        while ($rec = $query->fetch())
        {
            if ($rec['type'] == 'Magician')
            {
                $perso = new Magician();
            }
            if ($rec['type'] == 'Barbarian')
            {
                $perso = new Barbarian();
            }
            $perso->hydrate($rec);
            $persos[] = $perso;
        }
        $query->closeCursor();

        return $persos;
    }

    public function add(Personage $perso)
    {
        $query = $this->_db->prepare('INSERT INTO Personage(name, xp, hp, atk, esc, str, def, type) VALUES(:name, :xp, :hp, :atk, :esc, :str, :def, :type)');
        $query->execute(array(
            'name' => $perso->name(),
            'xp' => $perso->xp(),
            'hp' => $perso->hp(),
            'atk' => $perso->atk(),
            'esc' => $perso->esc(),
            'str' => $perso->str(),
            'def' => $perso->def(),
            'type' => $perso->type()
        ));
        $query->closeCursor();
    }

    public function update(Personage $perso)
    {
        $query = $this->_db->prepare('UPDATE Personage SET name=:name, xp=:xp, hp=:hp, atk=:atk, esc=:esc, str=:str, def=:def, type=:type WHERE id=:id');
        $query->execute(array(
            'id' => $perso->id(),
            'name' => $perso->name(),
            'xp' => $perso->xp(),
            'hp' => $perso->hp(),
            'atk' => $perso->atk(),
            'esc' => $perso->esc(),
            'str' => $perso->str(),
            'def' => $perso->def(),
            'type' => $perso->type()
        ));
        $query->closeCursor();
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