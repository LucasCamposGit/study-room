
<head>
    <link rel="stylesheet" href="../css/login.css">
    <link rel="stylesheet" href="../css/structure.css">
    <script defer src="../js/login.js"></script>
</head>

<form action='index.php' method='POST' class="form">

    <div class="container-inputs">
        <h1>Sing in</h1>
        <p class="error"><?php if(isset($err)) echo $err; ?></p>
        <input type="email" class="login" 
                name="email" placeholder="e-mail" 
                autocomplete="off"
                value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>">

        <p class="requirements">A least a 5 characters password</p>
        <input type="password" pattern="[a-zA-Z-0-9]{5,}" class="password" placeholder="password" autocomplete="off">
        <input type="password" name="password" class="password" placeholder="confirm-password" autocomplete="off">

        <button name="submit">submit</button>
    </div>
</form>

