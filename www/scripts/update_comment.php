<?php
    include("bd.php");
    session_start();
    $uri = $_SERVER['REQUEST_URI'];
    $last_uri = $_SERVER['HTTP_REFERER'];

    // Check user permission
    // $email = $_SESSION["email"][0];
    // $user = getUser($email);

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