<?php
  include("bd.php");

  $resto = substr($uri, 17);
  $idEv = intval($resto); 
  $event = getEvent($idEv);

  if ( $event ){
    echo $twig->render('evento_imprimir.html', ['evento' => $event]);
  }
  else {
    echo $twig->render('404.html',[] );
  }
  
?>
