<?php
    include("php/model/bd.php");
    session_start();
    $uri = $_SERVER['REQUEST_URI'];

    // Check user permission
    if ( $_SESSION["email"][1] === "REGISTRADO" )
    {
        header("location:javascript://history.go(-1)");
        return;
    }

    // Get id
    if (isset($_GET['comment'])) {
        $idComment = $_GET['comment'];
    } else {
        $idComment = -1;
    }

    // Delete comment
    deleteComment($idComment);
    
    header("location:javascript://history.go(-1)");
?>