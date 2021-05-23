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

  // Proteger rutas 
  if (!$_SESSION["email"] && !in_array($uri, $unprotected) )
  {
    header('Location:/login');
    return;
  }

  // Proteger rutas admin
  if ( isset($_SESSION["email"]) ){
    $role = $_SESSION["email"][1];

    if ( 
         ( $role !== "SUPER" ) && ($uri === "/admin/usuarios" ) 
      || ( $role !== "SUPER" && $role !== "GESTOR" ) && ($uri === "/admin/eventos")
      || ( $role !== "SUPER" && $role !== "GESTOR" && $role !== "MODERADOR") && ($uri === "/admin/comentarios" )
    ) {
      header('Location:/');
      return;
    }
  }

  // Router

  // Events
  if (startWith($uri, "/add_comment.php")){
    include("php/scripts/add_comment.php");
  } else if (startWith($uri, "/evento/imprimir") ) {
    include("php/pages/evento_imprimir.php");
  } else if (startWith($uri, "/evento")){
    include("php/pages/evento.php");
  } 
  // Admin
  else if (startWith($uri, "/admin/comentarios") ){
    include("php/pages/admin/all_comments.php");
  } 
  else if (startWith($uri, "/admin/usuarios") ){
    include("php/pages/admin/all_users.php");
  }
  else if (startWith($uri, "/admin/eventos") ){
    include("php/pages/admin/all_events.php");
  }
  else if (startWith($uri, "/admin/evento") ){
    include("php/pages/admin/edit_event.php");
  }
    // Scripts
  else if (startWith($uri, "/delete_comment.php") ){
    include("php/scripts/delete_comment.php");
  }
  else if (startWith($uri, "/update_comment.php") ){
    include("php/scripts/update_comment.php");
  }
  else if (startWith($uri, "/delete_user.php") ){
    include("php/scripts/delete_user.php");
  }
  else if (startWith($uri, "/change_user_role.php")){
    include("php/scripts/change_user_role.php");
  }
  else if (startWith($uri, "/delete_event.php")){
    include("php/scripts/delete_event.php");
  } else if (startWith($uri, "/add_event.php")){
    include("php/scripts/add_event.php");
  } else if (startWith($uri, "/update_event.php")){
    include("php/scripts/update_event.php");
  }
  // Profile
  else if (startWith($uri, "/perfil") ){
    include("php/pages/profile.php");
  }
  else if (startWith($uri, "/change_user_info.php") ){
    include("php/scripts/change_user_info.php");
  }
  // Login - Register
  else if (startWith($uri, "/add_user.php")){
    include("php/scripts/add_user.php");
  } else if (startWith($uri, "/login_user.php")){
    include("php/scripts/login_user.php");
  }
  else if (startWith($uri, "/login") ){
    include("php/pages/login.php");
  } else if (startWith($uri, "/register")){
    include("php/pages/register.php");
  } else if (startWith($uri, "/logout.php") ){
    include("php/scripts/logout.php");
  } else if (startWith($uri, "/buscar") ){
    include("php/pages/search.php");
  }
  // Default
  else {
    include("php/model/bd.php");
    $events = ( $role === "SUPER" || $role === "GESTOR" ) 
                ? getEvents() 
                : getPublishedEvents();
    echo $twig->render('index.html', [
      'events'  => $events,
      'role' => $role
    ]);
  }

?>
 