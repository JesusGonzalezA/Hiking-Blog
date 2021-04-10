<?php
    include("bd.php");
    $uri = $_SERVER['REQUEST_URI'];

    addComment($_GET['ev'], $_POST['comment'], $_POST['name']);
    header('Location:/evento/' . $_GET['ev']);
?>