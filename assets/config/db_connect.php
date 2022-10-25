<?php 

    try{
        $db = new PDO('mysql:host=localhost;dbname=flashcards', 'lucas', 'lu250101');
    } catch (\PDOException $e){
        throw new \PDOException($e->getMessage(), $e->getCode());
    }
?>