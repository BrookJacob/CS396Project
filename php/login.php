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

        $sql = "SELECT userID, firstName, lastName, username, email, password FROM users WHERE username = '?'";
        $params = array( &$usernameEmail );
        $stmt = sqlsrv_query( $conn, $sql, $params );
        $row = sqlsrv_fetch( $stmt );
        $hash = substr($row['password'], 0, 60 );
        $usernameEmail = $_POST['usernameEmail'];
        $password = $_POST['password'];
        $login_ok = false;


        if( $stmt === false){
            die(print_r(sqlsrv_errors(), true));
        }
        echo 'I work';
        if($row){
			if( password_verify( $password, $hash) ){
              $login_ok = true;
            }
            echo 'got here';
        }
        if($login_ok){
            unset($row['password']);
            $_SESSION['user'] = $row;
            header("Location: library.php");
            die("Redirecting to: library.php");
        }else{
            print("Login failed");
            $submitted_username = htmlentities($_POST['usernameEmail'], ENT_QUOTES, 'UTF-8');
        }
    }
?>
</body>
</html>