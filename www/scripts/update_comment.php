<?php
    include("bd.php");
    session_start();
    $uri = $_SERVER['REQUEST_URI'];

    // Check user permission
    // $email = $_SESSION["email"][0];
    // $user = getUser($email);

    if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
        header('Location:/admin/comentarios');
        exit();
    }

    $index   = intval( $_POST['index'] );
    $content = $_POST['content'];

    // Update comment
    updateComment($index, $content);
    
    header('Location:/admin/comentarios');
?>