<?php 
    $dsn = 'mysql:host=localhost;dbname=flashcards';

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH,
        PDO::ATTR_EMULATE_PREPARES => false
    ];

    try{
        $db = new PDO($dsn, 'lucas', 'lu250101', $options);

    } catch (\PDOException $e){
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }
?>