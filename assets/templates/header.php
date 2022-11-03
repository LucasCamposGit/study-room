
    <header class="header">
        <a href='../../index.php' class="logo">Studying room</a>


        <ul class="links">
            <?php if (isset($_SESSION['login'])) { ?>
                <li><a href="reviewCards.php">review cards</a></li>
                <li><a href="cardCreation.php">create cards</a></li>
            <?php } else { ?>
                <li><button id="signIn">sign in</button></li>
                <li><button id="login">login</button></li>
            <?php }  ?>

        </ul>

    </header>