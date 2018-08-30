<?php

namespace controller;
use \model\PersonageManager;
use Exception;

class Game
{
    public function __construct()
    {
        $this->_state = self::GAME_INIT;
    }

    //attributes
    private $_state;
    public function state()
    {
        return $this->_state;
    }

    //constants
    const GAME_INIT = 0;
    const GAME_STARTED = 1;
    const GAME_PAUSED = 2;
    const GAME_OVER = 3;
    const GAME_END = 4;
    const GAME_ERROR = -1;

    public function initNew()
    {
        $this->_state = self::GAME_INIT;
    } 

    public function start()
    {
        $this->_state = self::GAME_STARTED;
        $this->stateChanged();
    } 

    public function pause()
    {
        $this->_state = self::GAME_PAUSED;
        $this->stateChanged();
    }

    public function end()
    {
        $this->_state = self::GAME_END;
        $this->stateChanged();
    }

    private function stateChanged()
    {
        header('Location: index.php');
    }

    public function newHeroCreated()
    {
        try
        {        
            if (Personage::nameIsValid(htmlspecialchars($_POST['name'])))
            {
                $hero = new Personage();
        
                $hero->setName($_POST['name']);
                $persoManager = new PersonageManager();

                if (!$persoManager->exists($hero->name()))
                {
                    $persoManager->add($hero);
                    $this->start();
                }
                else
                {
                    $heroname = $hero->name();
                    unset($hero);
                    unset($persoManager);
                    throw new Exception('Le personnage ' . $heroname . ' existe déjà.');
                }
            }
            else
            {
                throw new Exception('Il faut renseigner le nom d\'un personnage');
            }
        }
        catch (Exception $e)
        {
            $msg = $e->getMessage();
            $this->gameError($msg);
        }
    }

    public function heroSelected()
    {

    }

    public function gameError($msg)
    {
        $this->_state = self::GAME_ERROR;
        require('displayer.php');
        displayError($msg);
    }
}