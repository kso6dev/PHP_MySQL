<?php

namespace controller;

class Personage
{
    //constructor
    //public function __construct($id, $name, $xp, $hp, $atk, $esc, $str, $def)
    public function __construct()
    {
        /*
        $this->setId($id);
        $this->setName($name);
        
        $this->setXp($xp);
        $this->setHp($hp);

        $this->setAtk($atk);
        $this->setEsc($esc);
        $this->setStr($str);
        $this->setDef($def);
        */
        self::addCharNb();
    }
    
    public function set($id, $name, $xp, $hp, $atk, $esc, $str, $def)
    {
        $this->setId($id);
        $this->setName($name);
        
        $this->setXp($xp);
        $this->setHp($hp);

        $this->setAtk($atk);
        $this->setEsc($esc);
        $this->setStr($str);
        $this->setDef($def);
    }

    //hydratation
    public function hydrate(array $data)
    {
        //plutôt que de faire les assignations une à une comme plus bas
        //on va parcourir l'array reçue et si les noms correspondent à nos méthodes setters alors on va assigner
        foreach ($data as $key => $value)
        {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
        /*
        if (isset($data['id']))
        {
            $this->setId((int)$data['id']))
        }
        if (isset($data['name']))
        {
            $this->setName($data['name']))
        }
        if (isset($data['xp']))
        {
            $this->setXp((int)$data['xp']))
        }
        if (isset($data['hp']))
        {
            $this->setHp((int)$data['hp']))
        }
        if (isset($data['atk']))
        {
            $this->setAtk((int)$data['atk']))
        }
        if (isset($data['esc']))
        {
            $this->setEsc((int)$data['esc']))
        }
        if (isset($data['str']))
        {
            $this->setStr((int)$data['str']))
        }
        if (isset($data['def']))
        {
            $this->setDef((int)$data['def']))
        }
        */
    }

    //attributes
    private $_id;
    private $_name;
    
    private $_xp;
    private $_hp;
    
    private $_atk;
    private $_esc;
    private $_str;
    private $_def;
    


    //constants
    const MIN_XP = 1;
    const MAX_XP = 100;
    const DEFAULT_HP = 100;
    const MIN_HP = 0;
    const MAX_HP = 100;

    const DEFAULT_ATK = 10;
    const BIG_ATK = 18;
    const SMALL_ATK = 2;
    const DEFAULT_ESC = 10;
    const BIG_ESC = 18;
    const SMALL_ESC = 2;
    const DEFAULT_STR = 10;
    const BIG_STR = 18;
    const SMALL_STR = 2;
    const DEFAULT_DEF = 10;
    const BIG_DEF = 18;
    const SMALL_DEF = 2;
    
    const HIT_STATUS = 'has been hit';
    const DEF_STATUS = 'is defending';
    const DEAD_STATUS = 'is dead';
    const ATK_STATUS = 'is attacking';

    //getters setters
    public function id()
    {
        return $this->_id;
    }
    public function setId($id)
    {
        /*
        if (!is_int($id))
        {
            trigger_error('L\'id d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }
        */
        if ($id < 1)
        {
            trigger_error('L\'id d\'un personnage doit être un nombre entier positif', E_USER_WARNING);
            return;
        }
        $this->_id = $id;
    }

    public function name()
    {
        return $this->_name;
    }
    public function setName($name)
    {
        if (!is_string($name))
        {
            trigger_error('Le nom d\'un personnage doit être un texte', E_USER_WARNING);
            return;
        }
        $this->_name = $name;
    }

    public function xp()
    {
        return $this->_xp;
    }
    public function setXp($xp)
    {
        /*
        if (!is_int($xp))
        {
            trigger_error('L\'xp d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }
        */
        $this->_xp = $xp;
    }

    public function hp()
    {
        return $this->_hp;
    }
    public function setHp($hp)
    {
        /*
        if (!is_int($hp))
        {
            trigger_error('La santé d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }
        */
        if ($hp > self::MAX_HP)
        {
            trigger_error('La santé d\'un personnage ne peut pas dépasser 100', E_USER_WARNING);
            return;
        }
        $this->_hp = $hp;
    }

    public function atk()
    {
        return $this->_atk;
    }
    public function setAtk($atk)
    {
        /*
        if (!is_int($atk))
        {
            trigger_error('L\'attaque d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }
        */
        if ($atk > 100)
        {
            trigger_error('L\'attaque d\'un personnage ne peut pas dépasser 100', E_USER_WARNING);
            return;
        }
        if (in_array($atk, [self::DEFAULT_ATK, self::BIG_ATK, self::SMALL_ATK]))
        {
            $this->_atk = $atk;
        }
    }
    
    public function esc()
    {
        return $this->_esc;
    }
    public function setEsc($esc)
    {
        /*
        if (!is_int($esc))
        {
            trigger_error('L\'esquive d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }
        */
        if ($esc > 100)
        {
            trigger_error('L\'esquive d\'un personnage ne peut pas dépasser 100', E_USER_WARNING);
            return;
        }
        if (in_array($esc, [self::DEFAULT_ESC, self::BIG_ESC, self::SMALL_ESC]))
        {
            $this->_esc = $esc;
        }
    }
    
    public function str()
    {
        return $this->_str;
    }
    public function setStr($str)
    {
        /*
        if (!is_int($str))
        {
            trigger_error('La force d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }
        */
        if ($str > 100)
        {
            trigger_error('La force d\'un personnage ne peut pas dépasser 100', E_USER_WARNING);
            return;
        }
        if (in_array($str, [self::DEFAULT_STR, self::BIG_STR, self::SMALL_STR]))
        {
            $this->_str = $str;
        }
    }

    public function def()
    {
        return $this->_def;
    }
    public function setDef($def)
    {
        /*
        if (!is_int($def))
        {
            trigger_error('La défense d\'un personnage doit être un nombre entier', E_USER_WARNING);
            return;
        }
        */
        if ($def > 100)
        {
            trigger_error('La défense d\'un personnage ne peut pas dépasser 100', E_USER_WARNING);
            return;
        }
        if (in_array($def, [self::DEFAULT_DEF, self::BIG_DEF, self::SMALL_DEF]))
        {
            $this->_def = $def;
        }
    }

    //methods
    public function attack(Character $opponent)
    {
        if ($opponent->id() == $this->_id)
        {
            trigger_error('Le personnage ne peut pas s\'attaquer lui-même', E_USER_WARNING);
            return;
        }
        else
        {
            $opponent->takeDammage($this->_atk + $this->_str);
        }
        return self::ATK_STATUS;
    }

    public function escape()
    {

    }

    public function defend()
    {

    }

    public function heal($hpnb)
    {
        $this->_hp = $this->_hp + $hpnb;
    }

    public function takeDammage($dmgtaken)
    {
        $status = self::DEF_STATUS;
        $dmg = $dmgtaken - $this->_def;
        if ($dmg > 0)
        {
            $this->_hp = $this->_hp - $dmg;
            if ($this->_hp > 0)
            {
                $status = self::HIT_STATUS;
            }
            else
            {
                $status = self::DEAD_STATUS;
            }
        }
        return $status;
    }

    public function addXp($xpnb)
    {
        $this->_xp = $this->_xp + $xpnb;
    }

    public function display()
    {
        echo 'name: ' . $this->name() . '<br>';
        echo 'Xp: ' . $this->xp() . '<br>';
        echo 'Hp: ' . $this->hp() . '<br>';
        echo 'Str: ' . $this->str() . '<br>';
        echo 'Atk: ' . $this->atk() . '<br>';
        echo 'Def: ' . $this->def() . '<br>';
        echo 'Esc: ' . $this->esc() . '<br>';
    }

    //statics methods
    public static function speakdef()
    {
       
        echo self::$_speach.self::$_charnb.'! ';
    }

    public static function speak($sentence)
    {
        
        echo $sentence;
    }

    public static function addCharNb()
    {
        self::$_charnb = self::$_charnb + 1;
    }

    //statics attributes
    private static $_speach = 'Bonjour, je suis le personnage n°';
    private static $_charnb = 0;
}