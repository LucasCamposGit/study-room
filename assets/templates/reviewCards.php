<?php session_start(); ?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/structure.css">
    <link rel="stylesheet" href="../css/reviewCards.css">

    <script defer src="../js/reviewCards.js"></script>

    <title>Document</title>
</head>
<body>
    
    <?php require("header.php"); ?>
    <?php require("../config/reviewList.php"); ?>
  
    <main>
        <div class="card">
                <a href="cardCreation.php?card_id=1" class="card-config">
                    <img title='Edit card' src="../images/wrench.svg" alt="edit-card">
                </a>
                <p class="card-number">1</p>
            <h1 class="title">card's front</h1>
          
            <button class="btn previous">previous card</button>
            <button class="btn next">next card</button>

            <div class="front face"></div>
            <div class="back face hide"></div>

            <button class="btn turn">turn card's face</button>
            
        </div>

    
        <div class="time-container">
            <h1>Select a kind of revision: </h1>
            <input type="radio" name="time" id="all" class="time" checked>
            <label for="all">All <p title="number of cards"></p></label>

            <input type="radio" name="time" id="24"  class="time">
            <label for="24">from 1 to 6 days <p title="number of cards"></p></label>

            <input type="radio" name="time" id="7"  class="time">
            <label for="7"> from 7 to 29 days <p title="number of cards"></p> </label>

            <input type="radio" name="time" id="1"  class="time">
            <label for="1">from 1 to 3 months <p title="number of cards"></p> </label>

            <input type="radio" name="time" id="3"  class="time">
            <label for="3">more than  3 months<p title="number of cards"></p> </label>
        </div>
    </main>

    <?php require('./footer.php') ?>

</body>
</html>