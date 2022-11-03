<?php session_start(); ?>
<?php require("./assets/config/db_connect.php"); ?>
<?php
function  isEmailExists($db, $tablename, $email)
{

    $sql = "SELECT * FROM " . $tablename . " WHERE email='" . $email . "'";

    $results = $db->query($sql);

    $row = $results->fetchAll();

    return (is_array($row) && sizeof($row));
}

if (isset($_POST['submit'])) {

    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        $sql = 'INSERT INTO users(email, password) VALUES (?, ?)';
        $sql = $db->prepare($sql);


        if (!isEmailExists($db, 'users', $_POST['email'])) {
            try {
                $sql->execute([$_POST['email'], $_POST['password']]);
                $success = 'You created your account successfuly!, please login';
            } catch (PDOException $e) {
                echo "Error: " . $e;
            }
        } else {
            $err = 'This e-mail already exists';
        };
    } else {
        $err = 'An e-mail and password is necessary';
    }
}

if (isset($_POST['submit-login'])) {

    if (!empty($_POST['email-login']) && !empty($_POST['password-login'])) {

        $email = $_POST['email-login'];
        $password = $_POST['password-login'];

        $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $login = $db->query($sql);
        $login = $login->fetchAll();
        print_r($login);

        if (isset($login) && sizeof($login) > 0) {
            $_SESSION['id'] = $login[0][0];
            $_SESSION['login'] = $login[0][1];
        }
    } else {
        $errLogin = 'E-mail or password are wrong';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/structure.css">
    <link rel="stylesheet" href="./assets/css/login.css">

    <script defer src="./assets/js/index.js"></script>
    <script defer src="./assets/js/login.js"></script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9476187366410587" crossorigin="anonymous"></script>

    <link rel="shortcut icon" href="./assets/images/favicon-16x16.png" type="image/x-icon">


    <title>StudyRoom</title>
</head>

<body>

    <header class="header">
        <a href='index.php' class="logo">Studying room</a>


        <ul class="links">
            <?php if (isset($_SESSION['login'])) { ?>
                <li><a href="./assets/templates/reviewCards.php">review cards</a></li>
                <li><a href="./assets/templates/cardCreation.php">create cards</a></li>
            <?php } else { ?>
                <li><button id="signIn">sign in</button></li>
                <li><button id="login">login</button></li>
            <?php } ?>

        </ul>

    </header>


    <main>
        <aside>
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9476187366410587" crossorigin="anonymous"></script>
        </aside>


        <?php if (isset($_SESSION['login'])) { ?>
            <div class="greetings">
                <h1>Welcome, <?php echo explode("@", $_SESSION['login'])[0]; ?></h1>
                <p>Here is a enviroment that you can use to study!</p>
                <p>
                    Each flahscard is a piece of information that you can review any time you want.<br>
                    To create a card, click on the right top of the page, "create cards", and it will be avaiable to revision
                    in the "review cards" page.
                </p>
                <iframe src="https://www.youtube.com/embed/mzCEJVtED0U" title="How to Study Effectively with Flash Cards - College Info Geek" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>

            <div class="container-info">
                <h1>Little tips to help you</h1>
                    <ol>
                        <li>Make Your Own Flash Cards.</li>
                        <li>Use Mnemonic Devices to Create Mental Connections.</li>
                        <li>Write Only One Question Per Card.</li>
                        <li>Break Complex Concepts Into Multiple Questions.</li>
                        <li>Say Your Answers Out Loud When Studying.</li>
                    </ol>
            </div>

        <?php } else { ?>
            <div class="greetings">
                <h1>Welcome!</h1>
                <p>
                    Here is a enviroment that you can use to study!
                    <br>
                    <br>
                    You can create your own flashcards, revisioning them by date eventually, and soon by subjects.
                    <br>
                    <br>
                    This is a completely free platform, so feel free to study as many as you want. We don't have a card's amount limit!

                </p>
                <p>Please, login to start your journey!</p>

                <iframe src="https://www.youtube.com/embed/I5uBpnufxiA" title="How do flashcards work? (feat. Flashcards)" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            </div>


            <div class="container-info">
                <h1>What is a flashcard?</h1>
                <p>By google, a flashcard is a card containing a small amount of information, held up for students to see, as an aid to learning.</p>
                <h1>How do I use this approach?</h1>
                <p>
                    Traditional use of flashcards is for memorization only. It is important to use the flashcards multiple times. Just like the first time you review any relatively new information, the first time you use the flashcards may be a bit overwhelming or frustrating because of the “forgetting” that has occurred. Here's the good news: with repetition, you will remember more and more, therefore forgetting less and less. The “forgetting curve” levels out, and the learning becomes “durable”. (Essentially, this means you will remember the information long term!)
                    <br>
                    <br>
                    While there is some value to remembering key terms and other information, it's important to remember that in college there is far less memorization than in high school, as learners need to be able to apply and make meaning of information. Below are the steps to create your flashcards, along with approaches to test memory and make meaning of the information as you go along.
                </p>
            </div>
        <?php } ?>


        <div class="success">
            <h1><?php if (isset($success)) {
                    echo $success; ?></h1>
            <p class="right">✓</p>
        <?php } ?>
        </div>


        <div class="container-signIn <?php if (!isset($err)) echo 'hide' ?>">
            <?php require('./assets/templates/signIn.php') ?>
        </div>

        <div class="container-login <?php if (!isset($errLogin)) echo 'hide' ?>">
            <?php require('./assets/templates/login.php') ?>
        </div>

    </main>

    <?php require('./assets/templates/footer.php') ?>

</body>

</html>