<?php
    include("php/model/bd.php");
    session_start();

    $eventsComments  = getAllComments();
    
    echo $twig->render('admin/all_comments.html',[
        'eventsComments' => $eventsComments,
        'role'        => $_SESSION["email"][1]
    ] );
?>
