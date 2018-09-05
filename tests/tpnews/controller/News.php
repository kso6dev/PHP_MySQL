<?php

class News
{
    protected $errors = [];
    protected $_id;
    protected $_title;
    protected $_content;
    protected $_creation_date;
    protected $_modification_date;
    protected $_author;

    /**
     * Constants errors
     */
    const INVALID_AUTHOR = 1;
    const INVALID_TITLE = 2;
    const INVALID_CONTENT = 3;

    public function __construct($values = [])
    {
        if (!empty($values))
        {
            $this->hydrate($values);
        }
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key => $value)
        {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method))
            {
                if (strpos($method, 'date') > 0)
                {
                    $this->$method(new DateTime($value));
                }
                else
                {
                    $this->$method($value);
                }
            }
        }
    }

    public function errors()
    {
        return $this->errors;
    }

    public function id()
    {
        return $this->_id;
    }
    public function setId($id)
    {
        $this->_id = (int)$id;
    }
    public function title()
    {
        return $this->_title;
    }
    public function setTitle($title)
    {
        if (!is_string($title) || empty($title))
        {
           $this->errors[] = self::INVALID_TITLE; 
        }
        else
        {
            $this->_title = $title;
        }
    }
    public function content()
    {
        return $this->_content;
    }
    public function setContent($content)
    {
        if (!is_string($content) || empty($content))
        {
           $this->errors[] = self::INVALID_CONTENT; 
        }
        else
        {
            $this->_content = $content;
        }
    }
    public function creation_date()
    {
        return $this->_creation_date;
    }
    public function setCreation_date(DateTime $creation_date)
    {
        $this->_creation_date = $creation_date;
    }
    public function modification_date()
    {
        return $this->_modification_date;
    }
    public function setModification_date(DateTime $modification_date)
    {
        $this->_modification_date = $modification_date;
    }
    public function author()
    {
        return $this->_author;
    }
    public function setAuthor($author)
    {
        if (!is_string($author) || empty($author))
        {
           $this->errors[] = self::INVALID_AUTHOR; 
        }
        else
        {
            $this->_author = $author;
        }
    }

    /**
     * Méthode permettant de savoir si la news est nouvelle
     */
    public function isNew()
    {
        return empty($this->_id);
    }

    /**
     * Méthode permettant de savoir si la news est valide
     */
    public function isValid()
    {
        return !(empty($this->_author) || empty($this->_content) || empty($this->_title));
    }

}