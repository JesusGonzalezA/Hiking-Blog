<?php
    include("php/model/bd.php");
    session_start();
    $uri = $_SERVER['REQUEST_URI'];

    // Check user permission
    if ( $_SESSION["email"][1] !== "SUPER" && $_SESSION["email"][1] !== "GESTOR" )
    {
        header("Location:/admin/eventos");
        return;
    }

    // Get info from form
    $title       = $_POST['title'];
    $place       = $_POST['place'];
    $date        = $_POST['date'];
    $author      = $_SESSION["email"][0];
    $description = $_POST['description'];
    $tags        = $_POST['tag'];

    if( empty($title)
        || empty($place)
        || empty($date)
        || !isset( $_FILES['photo'] )
    ){
        header("Location:/admin/eventos");
        return;
    }

    // Upload file 
    $errors= array();
    $file_name = $_FILES['photo']['name'];
    $file_size = $_FILES['photo']['size'];
    $file_tmp  = $_FILES['photo']['tmp_name'];
    $file_type = $_FILES['photo']['type'];
    $file_ext = strtolower(end(explode('.',$_FILES['photo']['name'])));
    $extensions= array("jpeg","jpg","png");
    
    if ( !in_array( $file_ext, $extensions) ){
        $errors[] = "Extension no permitida, elige una imagen JPEG o PNG.";
    }
    
    if ( $file_size > 2097152 ){
        $errors[] = 'Tamano del fichero demasiado grande';
    }
    
    // Add event
    if ( empty($errors) ) {
        move_uploaded_file($file_tmp, "assets/places/" . $file_name);
        $photo = "/assets/places/" . $file_name;
        $idEvent = addEvent( $photo, $title, $place, $date, $author, $description );

        if ( !empty($tags) ) {
            foreach ( $tags as $tag ) {
                addTag( $tag, $idEvent );
            }
        }
    } else {
        setcookie( 'error_add_event', implode('|', $errors) ); 
    }

    header("Location:/admin/eventos");
?>