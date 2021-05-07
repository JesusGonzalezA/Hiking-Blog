<?php
  include("bd.php");

  $resto   = substr($uri, 8);
  $idEv    = intval($resto); 
  $event   = getEvent($idEv);
  $gallery = getGallery($idEv);
  $tags    = getTags($idEv); 
  $banned  = getBannedWords();

  if ( $event ){
    $comments = getComments($event['id']);
    echo $twig->render('evento.html', [
      'evento' => $event,
      'comentarios' => $comments,
      'gallery' => $gallery,
      'tags' => $tags,
      'banned' => implode(";", $banned)
    ]);
  }
  else {
    echo $twig->render('404.html',[] );
  }
  
?>
