<?php
    include('bd.php');

    $users = getUsers();

    echo $twig->render('admin/all_users.html',[
        'users' => $users
    ] );
?>
