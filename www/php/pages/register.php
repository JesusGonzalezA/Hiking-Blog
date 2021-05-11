<?php
    session_start();
    unset($_SESSION['email']);
    echo $twig->render('register.html',[] );
?>
