<?php

class Game
{
    public function __construct()
    {
        $this->_state = self::GAME_INIT;
    }

    //attributes
    private $_state;

    //constants
    const GAME_INIT = 0;
    const GAME_STARTED = 1;
    const GAME_PAUSED = 2;
    const GAME_OVER = 3;
    const GAME_END = 4;

    public function initNew()
    {
        $this->_state = self::GAME_INIT;
        $this->display();
    } 

    public function start()
    {
        $this->_state = self::GAME_STARTED;
        $this->display();
    } 

    public function pause()
    {
        $this->_state = self::GAME_PAUSED;
    }

    public function end()
    {
        $this->_state = self::GAME_END;
    }

    private function display()
    {
        if ($this->_state == self::GAME_INIT)
        {
            require('view/introView.php');
        }
    }
}