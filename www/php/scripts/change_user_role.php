<?php
    include("php/model/bd.php");
    session_start();
    $uri = $_SERVER['REQUEST_URI'];

    if (isset($_GET['user']) && isset($_GET['role'])) {
        $idUser = $_GET['user'];
        $role   = $_GET['role'];
    } else {
        header("Location:/admin/usuarios");
        return;
    }

    $user = getUserById($idUser);

    // Check user permission
    if ( $_SESSION["email"][0] === $user['email'] || $_SESSION["email"][1] !== "SUPER")
    {
        setcookie('error_change_role', "No puedes cambiar tu rol" );
        header("Location:/admin/usuarios");
        return;
    }

    if (isset($_COOKIE['error_change_role']))
        setcookie( 'error_change_role' ); 

    // Delete user
    changeRole($idUser, $role);
    header("Location:/admin/usuarios");
?>