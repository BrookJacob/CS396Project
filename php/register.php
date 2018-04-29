<html>
<head>
    <title>library books</title>
    <link href="../css/main.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
</head>
    <body class="splash">
        <div class="backsplash"></div>
        <div class="menu-bar">
            <ul class="menu-buttons">
                <li class="menu-button"><a class="menu-button-link" href="../index.html">library books</a></li>
                <li class="menu-button"><a class="menu-button-link" href="../index.html#about">about</a></li>
                <li class="menu-button"><a class="menu-button-link" href="../index.html#feedback">feedback</a></li>
                <li class="menu-button menu-right"><a class="menu-button-link" href="login.php">sign in</a></li>
                <li class="menu-button menu-right"><a class="menu-button-link" href="register.php">sign up</a></li>
                <li class="cheat"></li>
            </ul>
        </div>
            <form class="signup" action="register.php" method="post">
                <h>sign up</h>
                <input class="signup-input" type="text" placeholder="first name" name="first-name">
                <input class="signup-input" type="text" placeholder="last name" name="last-name"><br>
                <input class="signup-input" type="text" placeholder="email" name="email"><br>
				<input class="signup-input" type="text" placeholder="username" name="username"><br>
                <input class="signup-input" type="password" placeholder="password" name="password">
                <input class="signup-input" type="password" placeholder="confirm password" name="confirm-password"><br>
				<input class="signup-input submit" type="submit" value="submit">
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

        $firstName = $_POST['first-name'];
        $lastName = $_POST['last-name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
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

        $sql = "INSERT INTO users (firstName, lastName, username, email, password)
                VALUES (?,?,?,?,?)";
        $params = array( &$firstName, &$lastName, &$email, &$username, &$passwordHash );
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