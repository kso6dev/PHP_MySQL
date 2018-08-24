<?php

    $pwd = '';
    $pwdspecified = false;

    //password_hash
    if (isset($_POST['newpwd']))
    {
        $pwd = $_POST['newpwd'];
        if ($pwd != '')
        {
            $pwd = password_hash($_POST['newpwd'],PASSWORD_DEFAULT);
            $pwdspecified = true;
        }
    }
?>