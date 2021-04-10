<?php
    include("scripts/bd.php");

    $comments = getComments(1);
    echo(print_r($comments));
?>