<?php
    //starting session before any html code
    session_start();

    //include libraries
    include('kso_phplib.php');
    include('memberspacesql.php');

    //init vars
    $login_post_infook = true;
    $login_post_error = '';
    $login_post_redirection = 'Location: index.php';

    //check register informations
    if (!isset($_POST['nickname']))
    {
        $login_post_error = 'Vous devez renseigner un pseudo.';
        $login_post_infook = false;
    }

    if (!isset($_POST['pwd']))
    {
        if ($login_post_error != '')
        {
            $login_post_error .= '\n';
        }
        $login_post_error .= 'Vous devez renseigner un mot de passe.';
        $login_post_infook = false;
    }

    if (!$login_post_infook)
    {
        $login_post_redirection = 'Location: login.php?ermsg='.$login_post_error;
    }
    else
    {
        $login_post_nickname = htmlspecialchars($_POST['nickname']);
        $login_pwd = $_POST['pwd'];
        //find member and check pwd, if found with pwd, return group id
        $login_member_group_id = (int) isMember($login_post_nickname, $login_pwd);
        if ($login_member_group_id != 0)
        {
            //keep user and group in session
            $_SESSION['nickname'] = $login_post_nickname;
            $_SESSION['grpid'] = $login_member_group_id;
        }
        else
        {
            $login_post_error .= 'Combinaison utilisateur mot de passe incorrecte';
            $login_post_redirection = 'Location: login.php?ermsg='.$login_post_error;
        }
    }
    
    //redirection 
    header($login_post_redirection);
?>
