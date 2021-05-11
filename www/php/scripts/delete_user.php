<?php
    include("php/model/bd.php");
    session_start();
    $uri = $_SERVER['REQUEST_URI'];

    if (isset($_GET['user'])) {
        $idUser = $_GET['user'];
    } else {
        $idUser = -1;
    }

    $user = getUserById($idUser);

    // Check user permission
    if ( $_SESSION["email"][0] === $user['email'] || $_SESSION["email"][1] !== "SUPER" )
    {
        setcookie('error_delete_user', "No puedes borrarte a ti mismo" );
        header("Location:/admin/usuarios");
        return;
    }

    if (isset($_COOKIE['error_delete_user']))
        setcookie( 'error_delete_user' ); 

    // Delete user
    deleteUser($idUser);
    header("Location:/admin/usuarios");
?>