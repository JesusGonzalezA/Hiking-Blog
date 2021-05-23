<?php
    include("php/model/bd.php");

  $resto = substr($uri, 17);
  $idEv = intval($resto); 
  $event = getEvent($idEv);
  $gallery = getGallery($idEv);

  if ( $event && 
    ( $event['isPublished'] || ( $role === "SUPER" || $role === "GESTOR" ) )  
  ){
    echo $twig->render('evento_imprimir.html', [
      'evento' => $event,
      'gallery' => $gallery
    ]);
  }
  else {
    echo $twig->render('404.html',[] );
  }
  
?>
