<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";
  include("scripts/bd.php");

  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  if (getUser("jesusgranada99a@gmail.com")){
    print("encontrado");
  }
  else{
    print("no");
  }
  print_r( getUser("jesusgranada99@gmail.com") );
?>
