<?php
    include("bd.php");
    session_start();
    $uri = $_SERVER['REQUEST_URI'];

    if ( $_SERVER['REQUEST_METHOD'] !== 'POST' ) {
        header('Location:/register');
        exit();
    }
    
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $exists = getUser($email);

    if( !filter_var($email, FILTER_VALIDATE_EMAIL) 
        || empty($name)
        || empty($password)
        || $exists
    ){
        if ( $exists )
            setcookie("error_register", "El usuario ya esta registrado" );

        header('Location:/register');
        return;
    }
    if (isset($_COOKIE['error_register']))
        setcookie( "error_register" ); 

    addUser($email, $name, $password);
    $_SESSION['email'] = array($email,'REGISTRADO');
    header('Location:/');
?>