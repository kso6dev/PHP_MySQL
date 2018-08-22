<?php
    //starting session before any html code
    session_start();

    //end session
    session_destroy();

    //redirection to index.php
    header('Location: index.php');
?>