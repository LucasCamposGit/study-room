<?php require("../config/db_connect.php")?>
<?php 
    function  isEmailExists($db, $tablename, $email){
        
        $sql = "SELECT * FROM ".$tablename." WHERE email='".$email."'";

        $results = $db->query($sql);

        $row = $results->fetchAll();

        return (is_array($row) && sizeof($row));

    }

    if(isset($_POST['submit'])){

        if (!empty($_POST['email']) && !empty($_POST['password'])){ 

            $sql = 'INSERT INTO users(email, password) VALUES (?, ?)';
            $sql = $db->prepare($sql);

            
            if (!isEmailExists($db, 'users', $_POST['email'])) {
                try{
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

        if (!empty($_POST['email-login']) && !empty($_POST['password-login'])){ 

            $email = $_POST['email-login'];
            $password = $_POST['password-login'];

            $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
            $login = $db->query($sql);
            $login = $login->fetchAll();
            
            if (isset($login) && sizeof($login) > 0){
                print_r($login);
                session_start();
                $_SESSION['login'] = $login[0][0];
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

    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../css/structure.css">

    <script defer src="../js/index.js"></script>
  

    <title>App</title>
</head>

<body>
    <?php require("header.php")?>

    <main>

        <div class="greetings">
            <h1>Welcome!</h1>
            <p>Here is a enviroment that you can use to study!</p>
            <p>Please, login to start your journey!</p>
        </div>
    
        <div class="success">
                <h1><?php if(isset($success)) {echo $success; ?></h1>
                <p class="right">✓</p>
            <?php } ?>
        </div>


        <div class="container-signIn <?php if(!isset($err)) echo 'hide' ?>">
            <?php require('signIn.php') ?>
        </div>

        <div class="container-login <?php if(!isset($errLogin)) echo 'hide' ?>">
            <?php require('login.php') ?>
        </div>
   
    </main>

</body>

</html>

