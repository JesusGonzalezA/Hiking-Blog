<?php
    include('bd.php');
    session_start();
    
    $users = getUsers();

    echo $twig->render('admin/all_users.html',[
        'users'   => $users,
        'role'        => $_SESSION["email"][1]
    ] );
?>
