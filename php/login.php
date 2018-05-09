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
    <form class="login" action="login.php" method="post">
        <h>sign in</h>
        <input class="login-input" type="text" placeholder="Username" name="username">
        <input class="login-input" type="password" placeholder="Password" name="password"><br>
        <input class="login-input submit" type="submit">
    </form>
<?php
    require("common.php");

    if(!empty($_POST))
    {

        $username = trim($_POST['username']);
        $password = trim($_POST['password']);

        $sql = "SELECT userID, firstName, lastName, email, userPassword FROM users WHERE username = '?'";
        $params = array( &$username );
        $stmt = sqlsrv_query( $conn, $sql, $params );
        echo sqlsrv_errors();
        if( $stmt === false) {
            echo "you buffon";
            die( print_r( sqlsrv_errors(), true) );
        }
        $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
        echo $row['username'];
        echo "this sucks";
        $hash = $row['userPassword'];
        
        if(password_verify( $password, $hash )){
            unset($row['userPassword']);
            $_SESSION['user'] = $row;

            header("Location: library.php");
            die("Redirecting to: library.php");
        } else {
            echo "cant login<br />";
        }
        
    }

    sqlsrv_close( $conn );
?>
</body>
</html>