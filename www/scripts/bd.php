<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $dotenv = \Dotenv\Dotenv::createImmutable( __DIR__, '.connection.env');
    $dotenv->load();

    function getEvent($idEv) {
      
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

    function getComments($idEv) {
      $mysqli = new mysqli("mysql", $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);

      if ( $mysqli->connect_errno) {
        echo ("Fallo al conectar: " . $mysqli->connect_errno);
      } 
      
      $stmt = $mysqli->prepare("SELECT author, date, comment, date description FROM comments WHERE idEvent=?");
      $stmt->bind_param("i", $idEv);
      $stmt->execute();
      $comments = $stmt->get_result()->fetch_all();
      $stmt->close();

      return $comments;
    }

    function addComment($idEvent, $comment, $author){
      $mysqli = new mysqli("mysql", $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);

      if ( $mysqli->connect_errno) {
        echo ("Fallo al conectar: " . $mysqli->connect_errno);
      } 
      
      $stmt = $mysqli->prepare("INSERT INTO comments (idEvent, comment, date, author) VALUES (?,?,NOW(),?)");
      $stmt->bind_param("iss", $idEvent, $comment, $author);
      $stmt->execute();
      $stmt->close();

      return $event;
    }

    function getBannedWords() {
      $mysqli = new mysqli("mysql", $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);

      if ( $mysqli->connect_errno) {
        echo ("Fallo al conectar: " . $mysqli->connect_errno);
      } 
      
      $stmt = $mysqli->prepare("SELECT word FROM banned_words");
      $stmt->execute();
      $banned = $stmt->get_result()->fetch_all();
      $stmt->close();

      $banned = array_map(function($word) {return $word[0];}, $banned);
      return $banned;
    }
?>