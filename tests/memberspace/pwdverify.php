<?php
    if (isset($_POST['pwd'])
    {
        $pwd = '';
        $pwdok = false;
    
        //get member hashed pwd

        //password_verify
        $pwdok = password_verify($_POST['pwd'], $pwd);
    }
?>