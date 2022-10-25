<?php 

    try{
        $db = new PDO('mysql:host=localhost;dbname=epiz_32863680_flashcards', 'epiz_32863680', 'DzVQpZJ80m');
    } catch (\PDOException $e){
        throw new \PDOException($e->getMessage(), $e->getCode());
    }
?>