<?php
    include("bd.php");
    $uri = $_SERVER['REQUEST_URI'];

    $name = $_POST['name'];
    $comment = str_word_count($_POST['comment'], 1);
    $email = $_POST['email'];
    $banned = getBannedWords();

    $isBanned = false; 
    foreach( $comment as $word ){
        if (in_array($word, $banned)){
            $isBanned = true;
            break;
        }
    }

    if(!isset($_GET['ev']) 
        || !filter_var($email, FILTER_VALIDATE_EMAIL) 
        || empty($comment)
        || empty($name)
        || $isBanned
    ){
        header('Location:/evento/' . $_GET['ev']);
        return;
    }
    $comment = $_POST['comment'];
    addComment($_GET['ev'], $comment, $name);
    header('Location:/evento/' . $_GET['ev']);
?>