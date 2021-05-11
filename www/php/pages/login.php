<?php
    unset($_SESSION['email']);
    echo $twig->render('login.html',[] );
?>
