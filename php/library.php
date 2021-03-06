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
        <ul class="my-library">
<?php

    require("common.php");

    if(empty($_SESSION['user'])){
        header("Location: login.php");
        die("Redirecting to login.php");
    }
    $userID = $_SESSION['user']['userID'];
    $sql = "SELECT b.ISBN13, b.title, b.author, g.genreName FROM books AS b, genres AS g, userlibrary AS l WHERE g.genreID = b.genreID AND l.ISBN13 = b.ISBN13 AND l.userID = ?";
    $params = array( &$userID );
    $stmt = sqlsrv_query( $conn, $sql, $params );
    if( $stmt === false ){
        die( print_r( sqlsrv_errors(), true) );
    }
    while ( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            echo '<li class="library-book"><a class="library-book-link" href="result.php?ISBN13='.$row['ISBN13'].'">'.$row['title'].', '.$row['author'].', '.$row['genreName'].'</a></li>';
    }



    sqlsrv_close( $conn );
?>
        </ul>
    </body>
</html>