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
                <p>name: </p><?php echo $_SESSION['firstName']." ".$_SESSION['lastName']; ?> 
                <input class="account-input" type="text" placeholder="first name" name="firstName"><br />
                <input class="account-input" type="text" placeholder="last name" name="lastName"><br />
                <p>email: </p><?php echo $_SESSION['email']; ?>
                <input class="account-input" type="text" placeholder="email" name="email"><br />
                <p>change your password</p>
                <input class="account-input" type="text" placeholder="old password" name="old-password"><br />
                <input class="account-input" type="text" placeholder="new password" name="new-password"><br />
                <input class="account-input" type="text" placeholder="confirm new password" name="confirm-password"><br />
                <input class="account-input" type="submit" value="update"><br />
            </form>

        </div>
<?php

    require("common.php");

    if(empty($_SESSION['user'])){
        header("Location: login.php");
        die("Redirecting to login.php");
    }
    $userID = $_SESSION['userID'];
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
        $lastName = $_POST['lastName'];
        $sql = "UPDATE users SET lastName = ? WHERE userID = ?";
        $params = array( &$lastName, &$userID);
        $stmt = sqlsrv_query( $conn, $sql, $params);
        if( $stmt === false ){
            die( print_r( sqlsrv_errors(), true) );
        }
    }
    if(!empty($_POST['email'])) {
        if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
            $email = $_POST['email'];
        } else {
            echo 'not a valid email address';
        }
        $sql = "UPDATE users SET lastName = ? WHERE userID = ?";
        $params = array( &$lastName, &$userID);
        $stmt = sqlsrv_query( $conn, $sql, $params);
        if( $stmt === false ){
            die( print_r( sqlsrv_errors(), true) );
        }
    }
    $sql = "SELECT userPassword FROM users WHERE userID = ?";
    $params = ( &$userID );
    $stmt = sqlsrv_query( $conn, $sql, $params );
    if( $stmt === false ){
        die( print_r( sqlsrv_errors(), true) );
    }
    $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );
    if(!empty($_POST['old-password']) || !empty($_POST['new-password']) || !empty($_POST['confirm-password'])) {
        if(empty($_POST['old-password']) || empty($_POST['new-password']) || empty($_POST['confirm-password'])) {
            echo 'all password fields must be filled out';
        } else if(!password_verify( $_POST['old-password'], $row['userPassword'])) {
            echo 'current password is incorrect';
        } else if($_POST['new-password'] != $_POST['confirm-password']) {
            echo 'passwords do not match';
        } else {
            $sql = "UPDATE users SET userPassword = ? WHERE userID = ?"
            $params = array( &$row['userPassword'], &$userID );
            $stmt = sqlsrv_query( $conn, $sql, $params );
            if( $stmt === false ){
                die( print_r( sqlsrv_errors(), true) );
            }
            unset($row['userPassword']);
        }
    }
    
    sqlsrv_close( $conn );
?>
    </body>
</html>