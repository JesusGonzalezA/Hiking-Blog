<?php
    include("php/model/bd.php");
    session_start();
    $uri = $_SERVER['REQUEST_URI'];

    // Check user permission
    if ( ($_SESSION["email"][1] !== "SUPER" ) && ($_SESSION["email"][1] !== "GESTOR" ) )
    {
        header("location:javascript://history.go(-1)");
        return;
    }

    echo $twig->render('admin/all_events.html',[
        'role'    => $_SESSION["email"][1]
    ] );
?>