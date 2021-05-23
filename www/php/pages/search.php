<?php
    include("php/model/bd.php");
    session_start();

    $email = $_SESSION["email"][0];
    
    echo $twig->render('search.html',[
        'role' => $_SESSION["email"][1]
    ] );
?>
