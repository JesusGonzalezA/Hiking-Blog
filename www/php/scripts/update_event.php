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
    $idEv        = $_POST['id'];
    $photo       = $_POST['photo'];
    $title       = $_POST['title'];
    $place       = $_POST['place'];
    $date        = $_POST['date'];
    $author      = $_SESSION["email"][0];
    $description = $_POST['description'];
    $tags        = $_POST['tag'];

    // Edit event
    updateEvent ( $idEv, $photo, $title, $place, $date, $description );
    updateTags ( $idEv, $tags );

    header("Location:/admin/evento/" . $idEv);
?>