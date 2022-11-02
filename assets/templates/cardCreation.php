<?php
session_start();
require('../config/db_connect.php');
require('../config/reviewList.php');

$front = $back = '';
$flag = isset($_GET['card_id']);
if ($flag) {
    $front = htmlspecialchars($cards[$_GET['card_id']]['front']);
    $back = htmlspecialchars($cards[$_GET['card_id']]['back']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../css/flashCard.css">
    <link rel="stylesheet" href="../css/structure.css">

    <script defer src="../js/flashCard.js"></script>

    <title>flash card</title>
</head>

<body>

    <?php require("header.php"); ?>

    <form class="form <?php if ($flag) echo "hide"; ?>">
        <p class="type-question">Type the card's front text</p>

        <input require name='input' type="text" id="input" placeholder="Here is where you type!" autocomplete="off">

        <button class="btn">Submit</button>

        <div class="card">

            <div class="face front "></div>
            <div class="face back hide"></div>

        </div>

    </form>

    <form class="submiting <?php if (!$flag) echo "hide"; ?>" action="cardCreation.php" method="POST">

        <h1>Front's Text</h1>
        <textarea type="text" name="front" id="showing-front" readonly><?php echo $front; ?></textarea>

        <h1>Back's Text</h1>
        <textarea type="text" name="back" id="showing-back" readonly> <?php echo $back; ?></textarea>

        <input type="text" name="card_id" hidden value="<?php if ($flag) {
                                                            echo $_GET['card_id'];
                                                        } ?>">
        <button id='btn-edit' type="button">Editar</button>
        <button id="btn-save" name="submit">Salvar</button>
    </form>

    <?php


    if (isset($_POST['submit'])) {

        if (!(strlen($_POST['front']) > 600)) {
            $front = $_POST['front'];
            $back = $_POST['back'];
            $user_id = $_SESSION['login'];
            $card_id;
            $sql;

            if ($_POST['card_id'] != '') {
                $card_id = intval($_POST['card_id']);
                $sql = "UPDATE cards SET front=?, back=? WHERE card_id=? AND user_id=?";
                $sql = $db->prepare($sql);

                try {
                    $sql->execute([$front, $back, $card_id + 1, $user_id]);
                } catch (\PDOException $d) {
                    throw new \PDOException($d->getMessage(), $d->getCode());
                }
            } else {
                $sql = "INSERT INTO cards(front, back, user_id) VALUES (?, ?, ?)";
                $sql = $db->prepare($sql);

                try {
                    $sql->execute([$front, $back, $user_id]);
                } catch (\PDOException $d) {
                    throw new \PDOException($d->getMessage(), $d->getCode());
                }
            }
        }
    }

    ?>
</body>

</html>