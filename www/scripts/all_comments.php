<?php
    include("bd.php");
    session_start();

    $eventsComments  = getAllComments();
    
    echo $twig->render('admin/all_comments.html',[
        'eventsComments' => $eventsComments
    ] );
?>
