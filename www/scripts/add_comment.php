<?php
    include("bd.php");
    $uri = $_SERVER['REQUEST_URI'];

    $name = $_POST['name'];
    $comment = $_POST['comment'];
    $email = $_POST['email'];

    if(!isset($_GET['ev']) 
        || !filter_var($email, FILTER_VALIDATE_EMAIL) 
        || empty($comment)
        || empty($name)
    ){
        return;
    }

    addComment($_GET['ev'], $comment, $name);
    header('Location:/evento/' . $_GET['ev']);
?>