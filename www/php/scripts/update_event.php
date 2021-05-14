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

    // Variables
    $idEv       = $_POST['id'];
    $errors     = array();
    $extensions = array("jpeg","jpg","png");

    // Photo
    if ( isset( $_FILES['photo'] ) && ($_FILES['photo']['size'] !== 0) ) {
        $file_name = $_FILES['photo']['name'];
        $file_size = $_FILES['photo']['size'];
        $file_tmp  = $_FILES['photo']['tmp_name'];
        $file_type = $_FILES['photo']['type'];
        $file_ext = strtolower(end(explode('.',$_FILES['photo']['name'])));

        if ( !in_array( $file_ext, $extensions) ){
            $errors[] = "Extension no permitida, elige una imagen JPG, JPEG o PNG.";
        }
        
        if ( $file_size > 2097152 ){
            $errors[] = 'Tamano del fichero demasiado grande';
        }
        
        // Update photo
        if ( empty($errors) ) {
            move_uploaded_file($file_tmp, "assets/places/" . $file_name);
            $photo = "/assets/places/" . $file_name;
            updatePhoto ( $idEv, $photo );
        }
    }

    // New gallery
    if ( empty($errors) && isset($_FILES['new_gallery']) && ($_FILES['new_gallery']['size'][0] !== 0) ) {
        for ( $i = 0; $i < count($_FILES['new_gallery']['name']); $i++) {
            $file_name = $_FILES['new_gallery']['name'][$i];
            $file_size = $_FILES['new_gallery']['size'][$i];
            $file_tmp  = $_FILES['new_gallery']['tmp_name'][$i];
            $file_type = $_FILES['new_gallery']['type'][$i];
            $file_ext = strtolower(end(explode('.',$_FILES['new_gallery']['name'][$i])));

            if ( !in_array( $file_ext, $extensions) ){
                $errors[] = "Extension no permitida elige una imagen JPEG, JPG o PNG.";
            }
            
            if ( $file_size > 2097152 ){
                $errors[] = 'Tamano del fichero demasiado grande';
            }
            
            // Update photo
            if ( empty($errors) ) {
                move_uploaded_file($file_tmp, "assets/places/" . $file_name);
                $photo = "/assets/places/" . $file_name;
                addToGallery ( $idEv, $photo );
            } else {
                break;
            }
        }

    } 

    // Get info from form
    if ( empty($errors) ) {
        $title          = $_POST['title'];
        $place          = $_POST['place'];
        $date           = $_POST['date'];
        $author         = $_SESSION["email"][0];
        $description    = $_POST['description'];
        $tags           = $_POST['tag'];
        $delete_gallery = $_POST['delete_gallery'];

        // Edit event
        updateEvent ( $idEv, $title, $place, $date, $description );
        deleteFromGallery ( $delete_gallery );
        updateTags ( $idEv, $tags );
    }
    else {
        setcookie( 'error_update_event', implode('|', $errors) ); 
    }

    header("Location:/admin/evento/" . $idEv);
?>