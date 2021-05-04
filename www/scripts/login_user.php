<?php
    include("bd.php");
    $uri = $_SERVER['REQUEST_URI'];

    if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
        header('Location:/login');
        exit();
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = getUser($email);

    if( !filter_var($email, FILTER_VALIDATE_EMAIL) 
        || empty($name)
        || empty($password)
        || !$user
    ){
        if ( !$user )
            setcookie('error_login', "El usuario no existe" );

        header('Location:/login');
        return;
    }
    
    if ( !password_verify($user['password'], $password) ){
        setcookie('error_login', "Las credenciales son incorrectas" );
        header('Location:/login');
        return;
    }
   
    if (isset($_COOKIE['error_login']))
        setcookie( 'error_login' ); 

    session_start();
    $_SESSION['email'] = $user['email'];
    header('Location:/');
?>