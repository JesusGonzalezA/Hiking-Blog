<?php
  include("bd.php");

  $resto = substr($uri, 8);
  $idEv = intval($resto); 
  $event = getEvent($idEv);
  
  if ( $event ){
    echo $twig->render('evento.html', ['evento' => $event]);
  }
  else {
    echo $twig->render('404.html',[] );
  }
  
?>
