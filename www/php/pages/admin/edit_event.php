<?php
    include("php/model/bd.php");
    session_start();

    $role = $_SESSION["email"][1];

    if ( $role !== "GESTOR" && $role !== "SUPER" ) {
        header("Location:/");
        return;
    }

    $resto   = substr($uri, 14);
    $idEv    = intval($resto); 
    $event   = getEvent($idEv);
    $gallery = getGallery($idEv);
    $allTags = getAllTags();
    $tags    = getTags($idEv); 


    if ( $event ){
        echo $twig->render('admin/evento.html', [
            'evento'      => $event,
            'gallery'     => $gallery,
            'tags'        => $tags,
            'role'        => $role,
            'allTags'     => $allTags
        ]);
    }
    else {
        echo $twig->render('404.html',[] );
    }
  
?>
