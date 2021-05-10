<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";

    $dotenv = \Dotenv\Dotenv::createImmutable( __DIR__, '.connection.env');
    $dotenv->load();
    $mysqli = null;

    function startMySqli() {
      $mysqli =  new mysqli("mysql", $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);

      if ( $mysqli->connect_errno) {
        echo ("Fallo al conectar: " . $mysqli->connect_errno);
        return null;
      } 

      return $mysqli;
    }

    function getEvent($idEv) {
      
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      
      
      $stmt = $mysqli->prepare("SELECT id, title, date, author, description, photo FROM events WHERE id=?");
      $stmt->bind_param("i", $idEv);
      $stmt->execute();
      $event = $stmt->get_result()->fetch_assoc();
      $stmt->close();

      return $event;
    }

    function getEvents() {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }    
      
      $stmt = $mysqli->prepare("SELECT id, photo, title, date FROM events");
      $stmt->execute();
      $events = $stmt->get_result()->fetch_all();
      $stmt->close();
      
      return $events;
    }

    function getComments($idEv) {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }     
      
      $stmt = $mysqli->prepare("SELECT author, date, comment, id, isEdited FROM comments WHERE idEvent=?");
      $stmt->bind_param("i", $idEv);
      $stmt->execute();
      $comments = $stmt->get_result()->fetch_all();
      $stmt->close();

      return $comments;
    }

    function getAllComments () {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }     
      
      // Get all events
      $stmt = $mysqli->prepare("SELECT id, title FROM events");
      $stmt->execute();
      $events = $stmt->get_result()->fetch_all();
      $stmt->close();

      // Get all comments
      for ( $i = 0; $i < count($events); $i++) {
        array_push($events[$i], getComments($events[$i][0]) );
      }

      return $events;
    }

    function addComment($idEvent, $comment, $author){
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }  
      
      $stmt = $mysqli->prepare("INSERT INTO comments (idEvent, comment, date, author) VALUES (?,?,NOW(),?)");
      $stmt->bind_param("iss", $idEvent, $comment, $author);
      $stmt->execute();
      $stmt->close();
    }

    function getBannedWords() {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }   
      
      $stmt = $mysqli->prepare("SELECT word FROM banned_words");
      $stmt->execute();
      $banned = $stmt->get_result()->fetch_all();
      $stmt->close();

      $banned = array_map(function($word) {return $word[0];}, $banned);
      return $banned;
    }

    function getGallery ($idEvent) {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }   
      
      $stmt = $mysqli->prepare("SELECT photo FROM gallery WHERE idEvent=?");
      $stmt->bind_param("i", $idEvent);
      $stmt->execute();
      $gallery = $stmt->get_result()->fetch_all();
      $stmt->close();

      $gallery = array_map(function($image) {return $image[0];}, $gallery);
      return $gallery;
    }

    function getTags ($idEvent) {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }   
      
      $stmt = $mysqli->prepare("SELECT description from TAGS, TAGS_EVENTS where TAGS.id=TAGS_EVENTS.idTag AND TAGS_EVENTS.idEvent=?");
      $stmt->bind_param("i", $idEvent);
      $stmt->execute();
      $tags = $stmt->get_result()->fetch_all();
      $stmt->close();

      $tags = array_map(function($tag) {return $tag[0];}, $tags);
      return $tags;
    }

    function getUsers() {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }    
      
      $stmt = $mysqli->prepare("SELECT idUser, name, email, isAdmin FROM users");
      $stmt->execute();
      $users = $stmt->get_result()->fetch_all();
      $stmt->close();
      
      return $users;
    }

    function getUser($email) {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      
      
      $stmt = $mysqli->prepare("SELECT name, email, password, isAdmin FROM users WHERE email=?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $user = $stmt->get_result()->fetch_assoc();
      $stmt->close();

      return $user;
    }

    function addUser($email, $name, $password) {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }  
      $encryptedPass = password_hash( $password, PASSWORD_DEFAULT );

      $stmt = $mysqli->prepare("INSERT INTO users (email, name, password) VALUES (?,?,?)");
      $stmt->bind_param("sss", $email, $name, $encryptedPass);
      $stmt->execute();
      $stmt->close();
      $mysqli->next_result();
    }

?>