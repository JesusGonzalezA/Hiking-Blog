<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";
  session_start();
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  
  function startWith($string, $query){
    return substr($string, 0, strlen($query)) === $query;
  }
  
  $uri = $_SERVER['REQUEST_URI'];
  $unprotected = array("/login", "/register", "/add_user.php", "/login_user.php");
  $admin       = array("/admin/comentarios", "/admin/usuarios");

  // Proteger rutas 
  if (!$_SESSION["email"] && !in_array($uri, $unprotected) )
  {
    header('Location:/login');
    return;
  }

  // Proteger rutas admin
  if ( isset($_SESSION["email"]) ){
    $isAdmin = $_SESSION["email"][1];

    if ( !$isAdmin && in_array($uri, $admin) ) {
      header('Location:/');
      return;
    }
  }

  // Router

  // Events
  if (startWith($uri, "/add_comment.php")){
    include("scripts/add_comment.php");
  } else if (startWith($uri, "/evento/imprimir") ) {
    include("scripts/evento_imprimir.php");
  } else if (startWith($uri, "/evento")){
    include("scripts/evento.php");
  } 
  // Admin
  else if (startWith($uri, "/admin/comentarios") ){
    include("scripts/all_comments.php");
  } 
  else if (startWith($uri, "/admin/usuarios") ){
    include("scripts/all_users.php");
  }
  else if (startWith($uri, "/delete_comment.php") ){
    include("scripts/delete_comment.php");
  }
  else if (startWith($uri, "/update_comment.php") ){
    include("scripts/update_comment.php");
  }
  // Profile
  else if (startWith($uri, "/perfil") ){
    include("scripts/profile.php");
  }
  else if (startWith($uri, "/change_user_info.php") ){
    include("scripts/change_user_info.php");
  }
  // Login - Register
  else if (startWith($uri, "/add_user.php")){
    include("scripts/add_user.php");
  } else if (startWith($uri, "/login_user.php")){
    include("scripts/login_user.php");
  }
  else if (startWith($uri, "/login") ){
    include("scripts/login.php");
  } else if (startWith($uri, "/register")){
    include("scripts/register.php");
  } else if (startWith($uri, "/logout.php") ){
    include("scripts/logout.php");
  }
  // Default
  else {
    include("scripts/bd.php");
    $events = getEvents();
    echo $twig->render('index.html', [
      'events'  => $events,
      'isAdmin' => $isAdmin
    ]);
  }

?>
 