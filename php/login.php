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
    <form class="login" action="login.php" method="post">
        <h>sign in</h>
        <input class="login-input" type="text" placeholder="username" name="usernameEmail" value="<?php echo $submitted_username; ?>">
        <input class="login-input" type="password" placeholder="password" name="password">
        <input class="login-input submit" type="submit">
    </form>
<?php
    require("common.php");

    if(!empty($_POST))
    {

        $login = false;
        $username = $_REQUEST['username'];
        $password = $_REQUEST['password'];

        $sql = "SELECT userID, firstName, lastName, email, userPassword FROM users WHERE username = '?'";
        $params = array( &$username );
        $stmt = sqlsrv_query( $conn, $sql, $params );

        while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
            $hash = $row['userPassword'];
            echo $row['userID'].", ".$row['firstName'].", ".$row['lastName'].", ".$row['email'].", ".$row['userPassword'];
        }

        echo $hash;
        if(password_verify( $password, $hash )){
            $login = true;
        }
        echo $login;
        if($login){
            unset($stmt[4]);
            $_SESSION['user'] = $stmt;

            header("Location: library.php");
            die("Redirecting to: library.php");
        } else {
            echo 'can\'t login';
        }
    }
?>
</body>
</html>