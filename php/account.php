<?php
    session_start();
?>
<html>
<head>
    <title>library books</title>
    <link href="../css/main.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
</head>
    <body class="splash">
        <div class="menu-bar">
            <ul class="menu-buttons">
                <li class="menu-button"><a class="menu-button-link" href="../index.php">library books</a></li>
                <li class="menu-button"><a class="menu-button-link" href="../index.php#about">about</a></li>
                <li class="menu-button"><a class="menu-button-link" href="../index.php#feedback">feedback</a></li>
                <?php
                if(empty($_SESSION['user'])){
                    echo '<li class="menu-button menu-right"><a class="menu-button-link" href="login.php">sign in</a></li>';
                    echo '<li class="menu-button menu-right"><a class="menu-button-link" href="register.php">sign up</a></li>';
                    echo '<li class="cheat"></li>';
                } else {
                    echo '<li class="menu-button"><a class="menu-button-link" href="library.php">my library</a></li>';
                    echo '<li class="menu-button menu-right"><a class="menu-button-link" href="account.php">account</a></li>';
                    echo '<li class="menu-button menu-right"><a class="menu-button-link" href="logout.php">log out</a></li>';
                    echo '<li class="cheat"></li>';
                }
                ?>
            </ul>
        </div>
        <div class="splash"></div>
        
        <div class="account">
            <form class="account-details" method="post">
                <p>update your name</p>
                <input class="account-input" type="text" placeholder="first name" name="firstName">
                <input class="account-input" type="text" placeholder="last name" name="lastName"><br />
                <p>update your email</p>
                <input class="account-input" type="text" placeholder="email" name="email"><br />
                <p>update your password</p>
                <input class="account-input" type="text" placeholder="old password" name="old-password"><br />
                <input class="account-input" type="text" placeholder="new password" name="new-password"><br />
                <input class="account-input" type="text" placeholder="confirm new password" name="confirm-password"><br />
                <input class="account-input" type="submit" value="update"><br />
                <p>delete your account</p>
                <input class="account-input" type="submit" value="delete your account">
            </form>

        </div>
<?php

    require("common.php");

    if(empty($_SESSION['user'])){
        header("Location: login.php");
        die("Redirecting to login.php");
    }
    

?>
    </body>
</html>