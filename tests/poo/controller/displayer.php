<?php

function display($gamestate)
{
    if ($gamestate == \controller\Game::GAME_INIT)
    {
        require('view/introView.php');
    }
    
    if ($gamestate == \controller\Game::GAME_STARTED)
    {
        require('view/gameView.php');
    }
}

function displayError($msg)
{
    $errorMessage = $msg;
    require('view/errorView.php');
}