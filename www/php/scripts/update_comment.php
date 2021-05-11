<?php
    include("php/model/bd.php");
    session_start();
    $uri = $_SERVER['REQUEST_URI'];
    $last_uri = $_SERVER['HTTP_REFERER'];

    // Check user permission
    if ( $_SESSION["email"][1] === "REGISTRADO" )
    {
        header('Location:' . $last_uri);
        return;
    }

    if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
        header('Location:' . $last_uri);
        exit();
    }

    $index   = intval( $_POST['index'] );
    $content = $_POST['content'];

    // Update comment
    updateComment($index, $content);
    
    header('Location:' . $last_uri);
?>