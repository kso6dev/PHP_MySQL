<?php
    //starting session before any html code
    session_start();

    //init vars
    $register_post_infook = true;
    $register_post_error = '';
    $register_post_redirection = 'Location: index.php';

    //check register informations
    if (!isset($_POST['nickname']))
    {
        $register_post_error = 'Vous devez renseigner un pseudo.';
        $infook = false;
    }
    if (!isset($_POST['pwd']))
    {
        if ($register_post_error != '')
        {
            $register_post_error += '\n';
        }
        $register_post_error += 'Vous devez renseigner un mot de passe.';
        $infook = false;
    }


    if (!$infook)
    {

    }
    
    
    //redirection 
    header($register_post_redirection);

    
?>
