<?php
    session_start();

    //connect to the database
    require ('db_connect.php');

    if (isset($_SESSION['login'])) {

        $id = $_SESSION['id'];

        $query = "SELECT front, back, card_id, created_at FROM cards WHERE user_id='$id'";
        $stmt = $db->query($query);

        $cards = $stmt->fetchAll();
        $jsonCards = json_encode($cards);
        
        echo $jsonCards;
    }
?>

