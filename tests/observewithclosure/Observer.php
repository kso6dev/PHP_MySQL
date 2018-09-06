<?php

class Observer implements SplObserver
{
    protected $name;
    protected $closure;

    public function __construct(Closure $closure, $name)
    {
        // On lie la closure à l'objet actuel et on lui spécifie le contexte à utiliser
        // (Ici, il s'agit du même contexte que $this)
        $this->closure = $closure->bindTo($this, $this);
        $this->name = $name;
    }

    public function update(SplSubject $subject)
    {
        // En cas de notification, on récupère la closure et on l'appelle
        $closure = $this->closure;
        $closure($subject);
    }

    public function getName()
    {
        return $this->name;
    }
}