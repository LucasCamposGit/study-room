<head>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/structure.css">
</head>

<form action='index.php' method='POST' class="form">

    <div class="container-inputs">
        <h1>Login</h1>

        <p class="error"><?php if(isset($errLogin)) echo $errLogin; ?></p>
        <input type="email" class="login" 
                name="email-login" placeholder="e-mail" 
                autocomplete="off"
                value="<?php if(isset($_POST['email-login'])) echo $_POST['email-login']?>">

        <input name='password-login' 
                type="password" class="password" 
                placeholder="password" 
                autocomplete="off">

        <button name="submit-login">submit</button>
    </div>
</form>