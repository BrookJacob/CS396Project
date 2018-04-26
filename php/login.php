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
    <form class="login" action="login.php" method="get">
        <h>sign in</h>
        <input class="login-input" type="text" placeholder="username" name="usernameEmail" value="<?php echo $submitted_username; ?>">
        <input class="login-input" type="password" placeholder="password" name="login-password">
        <input class="login-input submit" type="submit">
    </form>
<?php
//login method adapted from: http://forums.devshed.com/php-faqs-stickies-167/program-basic-secure-login-system-using-php-mysql-891201.html

    require("common.php");
    
    $submitted_username = '';

    if(!empty($_POST))
    {
        $usernameEmail = $_GET['usernameEmail'];
        $userPassword = $_GET['login-password'];
        $sql = "SELECT userID, firstName, lastName, username, email, userPassword, salt FROM users WHERE username = '?'";
        $params = array( &$usernameEmail );
        $stmt = sqlsrv_query( $conn, $sql, $params);
        if( $stmt === false){
            die(print_r(sqlsrv_errors(), true));
        }
        echo $stmt;
        $login_ok = false;
        $row = sqlsrv_fetch( $stmt );
        echo $row;
        if($row){
            print("hello");
            $check_password = hash('sha256', $_POST['login-password'] . $row['salt']);
            for($round = 0;$round < 65536;$round++){
                $check_password = hash('sha256', $check_password . $row['salt']);
            }
            if($check_password === $row['userPassword']){
                print("hello 1");
                $login_ok = true;
            }
        }
        if($login_ok){
            unset($row['salt']);
            unset($row['userPassword']);
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