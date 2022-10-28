<?php 
    require('db_connect.php');

    $query = 'SELECT front, back, card_id, created_at FROM cards';
    $stmt = $db->query($query);

    $cards = $stmt->fetchAll();
    
?>