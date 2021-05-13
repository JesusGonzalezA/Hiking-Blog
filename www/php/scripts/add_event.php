<?php
    include("php/model/bd.php");
    session_start();
    $uri = $_SERVER['REQUEST_URI'];

    // Check user permission
    if ( $_SESSION["email"][1] !== "SUPER" && $_SESSION["email"][1] !== "GESTOR" )
    {
        header("Location:/admin/eventos");
        return;
    }

    // Get info from form
    $photo       = $_POST['photo'];
    $title       = $_POST['title'];
    $place       = $_POST['place'];
    $date        = $_POST['date'];
    $author      = $_SESSION["email"][0];
    $description = $_POST['description'];
    $tags        = $_POST['tag'];

    if( empty($title)
        || empty($place)
        || empty($date)
    ){
        header("Location:/admin/eventos");
        return;
    }

    // Add event
    $idEvent = addEvent( $photo, $title, $place, $date, $author, $description );

    if ( !empty($tags) ) {
        foreach ( $tags as $tag ) {
            addTag( $tag, $idEvent );
        }
    }

    header("Location:/admin/eventos");
?>