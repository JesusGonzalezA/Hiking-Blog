<?php
  include("bd.php");
  session_start();

  $resto   = substr($uri, 8);
  $idEv    = intval($resto); 
  $event   = getEvent($idEv);
  $gallery = getGallery($idEv);
  $tags    = getTags($idEv); 
  $banned  = getBannedWords();
  $isAdmin = $_SESSION["email"][1];

  if ( $event ){
    $comments = getComments($event['id']);
    
    echo $twig->render('evento.html', [
      'evento'      => $event,
      'comentarios' => $comments,
      'gallery'     => $gallery,
      'tags'        => $tags,
      'banned'      => implode(";", $banned),
      'isAdmin'     => $isAdmin
    ]);
  }
  else {
    echo $twig->render('404.html',[] );
  }
  
?>
