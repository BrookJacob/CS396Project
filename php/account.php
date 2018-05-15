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
                <p>name: <?php echo $_SESSION['user']['firstName']." ".$_SESSION['user']['lastName']; ?></p> 
                <input class="account-input" type="text" placeholder="first name" name="firstName"><br />
                <input class="account-input" type="text" placeholder="last name" name="lastName"><br />
                <p>email: <?php echo $_SESSION['user']['email']; ?></p>
                <input class="account-input" type="text" placeholder="email" name="email"><br />
                <input class="account-input" type="text" placeholder="confirm email" name="confirm-email"><br />
                <input class="account-input" type="submit" value="update"><br />
            </form>

        </div>
<?php

    require("common.php");

    if(empty($_SESSION['user'])){
        header("Location: login.php");
        die("Redirecting to login.php");
    }
    $userID = $_SESSION['user']['userID'];
    if(!empty($_POST['firstName'])) {
        $firstName = $_POST['firstName'];
        $sql = "UPDATE users SET firstName = ? WHERE userID = ?";
        $params = array( &$firstName, &$userID);
        $stmt = sqlsrv_query( $conn, $sql, $params);
        if( $stmt === false ){
            die( print_r( sqlsrv_errors(), true) );
        }
    }
    if(!empty($_POST['lastName'])) {
        echo $_POST['lastName'];
        $lastName = $_POST['lastName'];
        $sql = "UPDATE users SET lastName = ? WHERE userID = ?";
        $params = array( &$lastName, &$userID);
        $stmt = sqlsrv_query( $conn, $sql, $params);
        if( $stmt === false ){
            die( print_r( sqlsrv_errors(), true) );
        }
    }
    if(!empty($_POST['email'])) {
        $email = $_POST['email'];
        $sql = "SELECT email FROM users WHERE email = ?";
        $params = array( &$email );
        $stmt = sqlsrv_query( $conn, $sql, $params );
        $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
        if( $stmt === false ){
            die( print_r( sqlsrv_errors(), true) );
        }
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) && !filter_var($_POST['confirm-email'], FILTER_VALIDATE_EMAIL)){
            echo 'not a valid email address';
        } else if( $row ) {
            echo $_POST['email'];
            echo 'email is already in use';
        } else if($_POST['email'] != $_POST['confirm-email']) {
           echo 'passwords do not match.';
        }
        $email = $_POST['email'];
        $sql = "UPDATE users SET email = ? WHERE userID = ?";
        $params = array( &$email, &$userID);
        $stmt = sqlsrv_query( $conn, $sql, $params);
        if( $stmt === false ){
            die( print_r( sqlsrv_errors(), true) );
        }
    }
    
    sqlsrv_close( $conn );
?>
    </body>
</html>