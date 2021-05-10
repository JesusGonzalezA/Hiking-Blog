<?php
    include("bd.php");
    session_start();
    $uri = $_SERVER['REQUEST_URI'];

    // Check user permission
    // $email = $_SESSION["email"][0];
    // $user = getUser($email);

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