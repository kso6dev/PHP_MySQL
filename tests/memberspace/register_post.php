<?php
    //starting session before any html code
    session_start();

    //include libraries
    include('kso_phplib.php');
    include('memberspacesql.php');

    //init vars
    $register_post_infook = true;
    $register_post_error = '';
    $register_post_redirection = 'Location: index.php';

    //check register informations
    if (!isset($_POST['nickname']))
    {
        $register_post_error = 'Vous devez renseigner un pseudo.';
        $register_post_infook = false;
    }

    if (!isset($_POST['pwd']))
    {
        if ($register_post_error != '')
        {
            $register_post_error += '\n';
        }
        $register_post_error += 'Vous devez renseigner un mot de passe.';
        $register_post_infook = false;
    }
    else
    if (!isset($_POST['pwdconfirm']))
    {
        if ($register_post_error != '')
        {
            $register_post_error += '\n';
        }
        $register_post_error += 'Vous devez confirmer votre mot de passe.';
        $register_post_infook = false;
    }
    else
    if ($_POST['pwd'] != $_POST['pwdconfirm'])
    {
        if ($register_post_error != '')
        {
            $register_post_error += '\n';
        }
        $register_post_error += 'Vous avez renseigné 2 mots de passe différents.';
        $register_post_infook = false;
    } 

    if (!emailisOk($_POST['email']))
    {
        if ($register_post_error != '')
        {
            $register_post_error += '\n';
        }
        $register_post_error += 'Vous devez renseigner une adresse mail valide.';
        $register_post_infook = false;
    }

    if (!$register_post_infook)
    {
        $register_post_redirection = 'Location: register.php?ermsg='.$register_post_error;
    }
    else
    {
        $register_post_member = array(
            'nickname' => htmlspecialchars($_POST['nickname']),
            'password' => $_POST['pwd'],
            'email' => htmlspecialchars($_POST['email'])
        );
        
        $register_post_error = registerMember($register_post_member);
        if ($register_post_error != '')
        {
            $register_post_redirection = 'Location: register.php?ermsg='.$register_post_error;
        }
    }
    
    //redirection 
    header($register_post_redirection);

    
?>
