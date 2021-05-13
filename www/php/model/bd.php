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

    // Event
    function getEvent($idEv) {
      
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      
      
      $stmt = $mysqli->prepare("SELECT id, title, place, date, author, description, photo FROM events WHERE id=?");
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

    function getEventsBasicInfo () {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }    
      
      $stmt = $mysqli->prepare("SELECT id, title FROM events");
      $stmt->execute();
      $events = $stmt->get_result()->fetch_all();
      $stmt->close();
      
      return $events;
    }

    function deleteEvent($idEvent) {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      
      
      $stmt = $mysqli->prepare("DELETE FROM events WHERE id=?");
      $stmt->bind_param("i", $idEvent);
      $stmt->execute();
      $stmt->close();
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

    function getTagsComplete ($idEvent) {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }   
      
      $stmt = $mysqli->prepare("SELECT description, idTag from TAGS, TAGS_EVENTS where TAGS.id=TAGS_EVENTS.idTag AND TAGS_EVENTS.idEvent=?");
      $stmt->bind_param("i", $idEvent);
      $stmt->execute();
      $tags = $stmt->get_result()->fetch_all();
      $stmt->close();

      return $tags;
    }

    function addEvent( $photo, $title, $place, $date, $author, $description ){
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }  
      $stmt = $mysqli->prepare("INSERT INTO events 
                                (photo, title, place, date, author, description) 
                                VALUES (?, ?, ?, ?, ?, ?)"
      );
      $stmt->bind_param("ssssss", $photo, $title, $place, $date, $author, $description);
      $stmt->execute();
      $lastId = $mysqli->insert_id;
      $stmt->close();

      return $lastId;
    }

    // Tags
    function getAllTags () {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }   
      
      $stmt = $mysqli->prepare("SELECT id, description from TAGS");
      $stmt->execute();
      $tags = $stmt->get_result()->fetch_all();
      $stmt->close();
      
      return $tags;
    }

    function addTag ( $idTag, $idEvent ) {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }  
      $stmt = $mysqli->prepare("INSERT INTO tags_events
                                (idTag, idEvent) 
                                VALUES (?, ?)"
      );
      $stmt->bind_param("ii", $idTag, $idEvent);
      $stmt->execute();
      $stmt->close();
    }

    // Comments
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

    function updateComment( $idComment, $comment ) {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      

      $stmt = $mysqli->prepare("UPDATE comments SET comment=?, isEdited=1 WHERE id=?");
      $stmt->bind_param("si", $comment,  $idComment );
      $stmt->execute();
      $stmt->close();
    }

    function deleteComment ( $idComment ) {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      

      $stmt = $mysqli->prepare("DELETE FROM comments WHERE id=?");
      $stmt->bind_param("i", $idComment );
      $stmt->execute();
      $stmt->close();
    }

    // Banned words
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

    // Users
    function getUsers() {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }    
      
      $stmt = $mysqli->prepare("SELECT idUser, email, role FROM users");
      $stmt->execute();
      $users = $stmt->get_result()->fetch_all();
      $stmt->close();
      
      return $users;
    }

    function getUser($email) {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      
      
      $stmt = $mysqli->prepare("SELECT name, email, password, role, idUser FROM users WHERE email=?");
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $user = $stmt->get_result()->fetch_assoc();
      $stmt->close();

      return $user;
    }

    function getUserById($idUser) {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      
      
      $stmt = $mysqli->prepare("SELECT name, email, role, idUser FROM users WHERE idUser=?");
      $stmt->bind_param("i", $idUser);
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

    function deleteUser($idUser){
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      
      
      $stmt = $mysqli->prepare("DELETE FROM users WHERE idUser=?");
      $stmt->bind_param("i", $idUser);
      $stmt->execute();
      $stmt->close();
    }

    function changeRole( $idUser, $role) {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      
      
      $stmt = $mysqli->prepare("UPDATE users SET role=? WHERE idUser=?");
      $stmt->bind_param("si", $role, $idUser);
      $stmt->execute();
      $stmt->close();
    }

    function changeUser( $idUser, $name, $email ) {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      
      
      $stmt = $mysqli->prepare("UPDATE users SET name=?, email=? WHERE idUser=?");
      $stmt->bind_param("ssi", $name, $email, $idUser);
      $stmt->execute();
      $stmt->close();

      // Update session
      session_start();
      $role = $_SESSION['email'];
      unset($_SESSION['email']);
      $_SESSION["email"] = array( $email, $role );
    }
    
    function changePass( $idUser, $password ) {
      if (!$mysqli){
        if ( !($mysqli = startMySqli() )) return;
      }      
      
      $encryptedPass = password_hash( $password, PASSWORD_DEFAULT );

      $stmt = $mysqli->prepare("UPDATE users SET password=? WHERE idUser=?");
      $stmt->bind_param("si", $encryptedPass,  $idUser );
      $stmt->execute();
      $stmt->close();
    }

?>