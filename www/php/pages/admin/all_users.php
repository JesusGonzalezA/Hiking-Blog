<?php
    include("php/model/bd.php");
    session_start();
    
    $users = getUsers();
    $roles = array("REGISTRADO", "MODERADOR", "GESTOR", "SUPER");

    echo $twig->render('admin/all_users.html',[
        'users'   => $users,
        'role'    => $_SESSION["email"][1],
        'roles'   => $roles
    ] );
?>
