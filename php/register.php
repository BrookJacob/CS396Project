<html>
<head>
    <title>library books</title>
    <link href="../css/main.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
</head>
    <body class="splash">
        <div class="menu-bar">
            <ul class="menu-buttons">
                <li class="menu-button"><a class="menu-button-link" href="index.html">library books</a></li>
                <li class="menu-button"><a class="menu-button-link" href="index.html#about">about</a></li>
                <li class="menu-button"><a class="menu-button-link" href="index.html#feedback">feedback</a></li>
                <li class="menu-button menu-right"><a class="menu-button-link" href="account.html">sign in</a></li>
                <li class="menu-button menu-right"><a class="menu-button-link" href="php/register.php">sign up</a></li>
                <li class="cheat"></li>
            </ul>
        </div>
        <div class="backsplash">
            <form class="login" action="register.php" method="post">
                <h>sign up</h>
                <input type="text" placeholder="first name" name="first-name">
                <input type="text" placeholder="last name" name="last-name">
                <input type="text" placeholder="email" name="email">
				<input type="text" placeholder="username" name="username">
                <input type="text" placeholder="password" name="password">
                <input type="text" placeholder="confirm password" name="confirm-password">
				<input type="submit" value="submit">
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
        $username = $_POST['username'];
        $params = array( &$username );
        $sql = "SELECT 1 FROM users WHERE username = '?'";
        $stmt = sqlsrv_query( $conn, $sql, $params );
        if ( $stmt === true){
            die("username is already taken");
        }
        $email = $_POST['email'];
        $params = array( &$email );
        $sql = "SELECT 1 FROM users WHERE email = '?'";
        $stmt = sqlsrv_query( $query, $sql, $params );
        if ( $stmt === true){
            die("email is already taken");
        }

    }
    
    sqlsrv_close( $conn );
?>
            </ul>
        </div>
</body>
</html>