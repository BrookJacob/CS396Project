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

    //$2y$10$pnMoff/rp0E9UoqdpfrgMuov8RKVzZupWpF/vCHSlbJ4u5kCq8SCm
    if(!empty($_POST))
    {

        $login = false;
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT userID, firstName, lastName, email, password FROM users WHERE username = '?'";
        $params = array( &$username );
        $stmt = sqlsrv_query( $conn, $sql, $params );
        try{
            $stmt = sqlsrv_query( $conn, $sql, $params );
        } catch (Exception $e) {
            die("failed to run query");
        }

        if(password_verify( $password, $stmt[4])){
            $login = true;
        }
        if($login){
            echo 'congrats';
        }

    }
?>
</body>
</html>