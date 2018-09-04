<?php

/**
 * @Table("personage")
 * @Type({'Magician', 'tank' = 'Barbarian', 'neutral' = 'Warrior', 'dps' = 'Elf'})
 * @Test('Ceci est une annotation test')
 * @ClassInfos(author = 'sosejik', version = '1.0')
 */

abstract class Personage implements iMovable
{
    //constructor
    public function __construct()
    {
        $className = static::class; //permet d'obtenir le nom de la class qui appelle (ici le constructeur donc le nom de la classe qui est instanciée)
        //$className = self::class; renverrait le nom de la classe dans laquelle on se trouve donc personage
        $className = ltrim($className, '\\'); //le nom de la class contient aussi le namespace et on en veut pas
        if ($lastNsPos = strrpos($className, '\\')) 
        {
            $className = substr($className, $lastNsPos + 1);
            $this->_type = $className;
        }
        self::addCharNb();
    }

    public function __clone()
    {
        //se déclenche quand un objet est créé par clone
        //comme le nouvel objet est un clone du précédent, le constructeur n'est pas appelé donc il faut ici gérer les particularités qu'on gérait dans construct
        self::addCharNb();
    }

    public function __destruct()
    {
        //se déclenche quand obj detruit
    }

    public function __set($name, $value)
    {
        //se déclenche quand on tente de set un attr qui n'existe pas
        echo 'attribut ' .$name . ' inconnu. Impossible de lui assigner la valeur ' .$value . '. Enfin si en vrai.. Fais un get tu verras tout est prévu dans mon code! <br>';
        $this->_newAttributes[$name] = $value; //on peut stocker les nouveaux attributs dans une var prévue, c'est comme ça qu'on créé des attr à la volée
    }

    public function __get($name)
    {
        //se déclenche quand on tente de set un attr qui n'existe pas
        //echo 'attribut ' .$name . ' inconnu. Impossible de récupérer sa valeur. <br>';
        if (isset($this->_newAttributes[$name]))
        {
            return $this->_newAttributes[$name];//on renvoit la valeur de l'attribut s'il existe dans notre tableau d'attributs => c'est dynamique!
        }
    }

    public function __isset($name)
    {
        //se déclenche quand on test si un vrai attribut existe et qu'il n'existe pas ou n'est pas accessible => isset(vraiAttr) renvoie faux
        //dans ce cas on peut renvoyer la valeur de isset sur nos attributs dynamiques!
        return isset($this->_newAttributes[$name]);
    }

    public function __unset($name)
    {
        //se déclenche quand on veut unset un vrai attribut et qu'il n'existe pas ou n'est pas accessible 
        //dans ce cas on peut unset l'attribut s'il existe dans nos attributs dynamiques!
        if (isset($this->_newAttributes[$name]))
        {
            unset($this->_newAttributes[$name]);
        }
    }

    public function __call($name, $args)
    {
        //se déclenche quand on veut invoquer une méthode qui n'existe pas ou à laquelle on n'a pas accès
    }

    public static function __callStatic($name, $args)
    {
        //se déclenche quand on veut invoquer une méthode statique qui n'existe pas ou à laquelle on n'a pas accès
    }

    /**
     * @ParamInfo(name = 'id', description = 'personage id')
     * @ParamInfo(name = 'name', description = 'personage name')
     * @ParamInfo(name = 'xp', description = 'personage experience')
     * @ParamInfo(name = 'hp', description = 'personage life')
     * @ParamInfo(name = 'atk', description = 'personage attack')
     * @ParamInfo(name = 'esc', description = 'personage esquive')
     * @ParamInfo(name = 'str', description = 'personage strength')
     * @ParamInfo(name = 'def', description = 'personage defense')
     * @MethodInfos(description = 'is used like a constructor but is not called when instantiate')
     */
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
    protected $_id;
    /**
     * @AttrInfos(description = 'it is the personage name')
     */
    protected $_name;
    /**
     * @AttrInfos(description = 'it is the personage type, it can be a Barbarian, a Magician etc')
     */
    protected $_type;
    
    protected $_xp = self::MIN_XP;
    protected $_hp = self::MAX_HP;
    
    protected $_atk = self::DEFAULT_ATK;
    protected $_esc = self::DEFAULT_ESC;
    protected $_str = self::DEFAULT_STR;
    protected $_def = self::DEFAULT_DEF;

    protected $_newAttributes = []; 

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
    public function type()
    {
        return $this->_type;
    }
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

    public function getNewAttribute($name)
    {
        return $this->_newAttributes[$name];
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
        echo 'type: ' . $this->type() . '<br>';
        echo 'Xp: ' . $this->xp() . '<br>';
        echo 'Hp: ' . $this->hp() . '<br>';
        echo 'Str: ' . $this->str() . '<br>';
        echo 'Atk: ' . $this->atk() . '<br>';
        echo 'Def: ' . $this->def() . '<br>';
        echo 'Esc: ' . $this->esc() . '<br>';
    }

    public function move($dest)
    {
        //function mandatory because implemented from interface iMovable
    }

    //statics methods
    public static function speakdef()
    {
       
        echo self::$_speach.self::$_charnb.'! <br>';
    }

    public static function speak($sentence)
    {
        
        echo $sentence . '<br>';
    }

    public static function nameIsValid($name)
    {
        $book = false;
        if ($name != '')
        {
            $book = true;
        }
        return $book;
    }

    public static function addCharNb()
    {
        self::$_charnb = self::$_charnb + 1;
    }

    
    //statics attributes
    protected static $_speach = 'Bonjour, je suis le personnage n°';
    protected static $_charnb = 0;
}