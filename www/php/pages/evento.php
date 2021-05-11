<?php
    include("php/model/bd.php");
  session_start();

  $resto   = substr($uri, 8);
  $idEv    = intval($resto); 
  $event   = getEvent($idEv);
  $gallery = getGallery($idEv);
  $tags    = getTags($idEv); 
  $banned  = getBannedWords();
  $role = $_SESSION["email"][1];
  $user = getUser($_SESSION["email"][0]);

  if ( $event ){
    $comments = getComments($event['id']);
    
    echo $twig->render('evento.html', [
      'evento'      => $event,
      'comentarios' => $comments,
      'gallery'     => $gallery,
      'tags'        => $tags,
      'banned'      => implode(";", $banned),
      'role'        => $role,
      'user'        => array($user['email'], $user['name'] )
    ]);
  }
  else {
    echo $twig->render('404.html',[] );
  }
  
?>
