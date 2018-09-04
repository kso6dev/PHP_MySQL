<?php

class Table extends Annotation {}
class Type extends Annotation {}
class Test extends Annotation {}

/** @Target("class") */
class ClassInfos extends Annotation 
{
    public $author;
    public $version;
    public function checkConstraints($target)
    {
        if (!is_string($this->author))
        {
            throw new Exception('L\'auteur doit être une chaîne de caractères');
        }

        if (!is_numeric($this->version))
        {
            throw new Exception('Le numéro de version doit être un nombre valide');
        }
    }
}

/** @Target("method") */
class MethodInfos extends Annotation {
    public $description;
}

/** @Target("method") */
class ParamInfo extends Annotation {
    public $description;
    public $name;
}

/** @Target("property") */
class AttrInfos extends Annotation {
    public $description;

}