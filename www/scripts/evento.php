<?php
  include("bd.php");

  $resto = substr($uri, 8);
  $idEv = intval($resto); 
  $event = getEvent($idEv);
  $banned = getBannedWords();

  // Set cookie
  setcookie("banned_words", implode(".", $banned) );
  
  if ( $event ){
    $comments = getComments($event['id']);
    echo $twig->render('evento.html', [
      'evento' => $event,
      'comentarios' => $comments
    ]);
  }
  else {
    echo $twig->render('404.html',[] );
  }
  
?>
