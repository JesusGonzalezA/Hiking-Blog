<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);
  
  function startWith($string, $query){
    return substr($string, 0, strlen($query)) === $query;
  }

  $uri = $_SERVER['REQUEST_URI'];

  if (startWith($uri, "/evento/imprimir") ) {
    include("scripts/evento_imprimir.php");
  } else if (startWith($uri, "/evento")){
    include("scripts/evento.php");
  }else {
    echo $twig->render('index.html', []);
  }

?>
 