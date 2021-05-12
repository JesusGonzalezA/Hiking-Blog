<?php
    include("php/model/bd.php");
    session_start();
    $uri = $_SERVER['REQUEST_URI'];

    if (isset($_GET['event'])) {
        $idEvent = $_GET['event'];
    } else {
        $idEvent = -1;
    }
    // Check user permission
    if ( $_SESSION["email"][1] !== "SUPER" && $_SESSION["email"][1] !== "GESTOR" )
    {
        header("Location:/admin/eventos");
        return;
    }

    // Delete event
    deleteEvent($idEvent);
    header("Location:/admin/eventos");
?>