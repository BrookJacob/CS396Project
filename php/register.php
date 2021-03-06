<?php
    session_start();
?>
<html>
<head>
    <title>library books</title>
    <link href="../css/main.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
</head>
    <body>
        <div class="splash"></div>
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
            <form class="signup" action="register.php" method="post">
                <h>sign up</h>
                <input class="signup-input" type="text" placeholder="First Name" name="first-name">
                <input class="signup-input" type="text" placeholder="Last Name" name="last-name"><br>
                <input class="signup-input" type="text" placeholder="Email" name="email"><br>
				<input class="signup-input" type="text" placeholder="Username" name="username"><br>
                <input class="signup-input" type="password" placeholder="Password" name="password">
                <input class="signup-input" type="password" placeholder="Confirm Password" name="confirm-password"><br>
				<input class="signup-input submit" type="submit" value="Submit">
			</form>
<?php

	require("common.php");
    
    if(!empty($_POST))
    {
        if(empty($_POST['first-name'])){
            die("please enter your first name.");
        }
        if(empty($_POST['last-name'])){
            die("please enter your last name.");
        }
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            die("please enter a valid email address.");
        }
        if(empty($_POST['username'])){
            die("please enter a username.");
        }
        if(empty($_POST['password'])){
            die("please enter an password");
        }
        if(empty($_POST['confirm-password'])){
            die("please confirm your password.");
        }
        if($_POST['password'] != $_POST['confirm-password']){
            die("please enter matching passwords");
        }

        $firstName = trim($_POST['first-name']);
        $lastName = trim($_POST['last-name']);
        $email = trim($_POST['email']);
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $passwordHash = password_hash( $password, PASSWORD_DEFAULT);

        $sql = "SELECT 1 FROM users WHERE username = '?'";
        $params = array( &$username );
        $stmt = sqlsrv_query( $conn, $sql, $params );
        if( $stmt == false ){
            die("username already taken");
        }

        $sql = "SELECT 1 FROM users WHERE email = '?'";
        $params = array( &$email );
        $stmt = sqlsrv_query( $conn, $sql, $params );
        if( $stmt == false ){
            die("email already in use");
        }

        $sql = "INSERT INTO users (firstName, lastName, username, email, userPassword)
                VALUES (?,?,?,?,?)";
        $params = array( &$firstName, &$lastName, &$username, &$email, &$passwordHash );
        $stmt = sqlsrv_query( $conn, $sql, $params );
        if( $stmt == false ){
            die("query does not work");
        }

        header("Location: login.php");

    }
    
    sqlsrv_close( $conn );
?>
        
</body>
</html>