<?php     
    include("php/model/bd.php");
    session_start();
    header('Content-Type: application/json');

    $role  = $_SESSION["email"][1];
    $query = $_GET['q'];

    if ( empty( $query ) ) {
        $events = [];
    } else if ( $role === "SUPER" || $role === "GESTOR" ) {
        $events = searchEvents( $query );
    } else {
        $events = searchBasicEvents( $query );
    }

    echo( json_encode(  $events ) );
?>