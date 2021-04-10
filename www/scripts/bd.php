<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    function getEvent($idEv) {
      $dotenv = \Dotenv\Dotenv::createImmutable( __DIR__, '.connection.env');
      $dotenv->load();
      
      $mysqli = new mysqli("mysql", $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);

      if ( $mysqli->connect_errno) {
        echo ("Fallo al conectar: " . $mysqli->connect_errno);
      } 
      
      $stmt = $mysqli->prepare("SELECT id, title, date, author, description FROM events WHERE id=?");
      $stmt->bind_param("i", $idEv);
      $stmt->execute();
      $event = $stmt->get_result()->fetch_assoc();
      $stmt->close();

      return $event;
    }
?>