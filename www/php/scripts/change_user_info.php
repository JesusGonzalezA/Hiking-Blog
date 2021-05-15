<?php
    include("php/model/bd.php");
    session_start();
    $uri = $_SERVER['REQUEST_URI'];

    if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
        header('Location:/login');
        exit();
    }

    if (isset($_COOKIE['error_update']))
        setcookie( 'error_update' );

    // Get user
    $email = $_SESSION["email"][0];
    $user = getUser($email);

    // Get data from form
    $name     = $_POST['name'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    // Validate form
    $changePass = !empty($password);

    if( !$user ) {
        header('Location:/login.php');
        return;
    }

    // Update user
    if ( $changePass ){
        changePass($user['idUser'], $password );
    }
    else {
        if ( empty($name)  ) $name  = $user['name'];
        if ( empty($email) ) $email = $user['email'];

        $changingEmail = ( $email !== $user['email'] );
        $error = false;

        if ( $changingEmail ) {
            // Error
            if ( getUser($email) ) {
                $error = true;
            }
        }

        if ( $error ) setcookie('error_update', "El email no esta disponible" );
        else {
            changeUser($user['idUser'], $name, $email);
            unset($_SESSION['email']);
            $_SESSION['email'] = array($email,$user['role']);
        }
    }
    header('Location:/perfil');
?>