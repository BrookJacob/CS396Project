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
        </div>
        <div class="result-search-bar">
            <form class="main-search-bar" name="search" action="search.php?go" method="post">
                <input class="main-search-bar" type="text" name="main-search-bar" placeholder="isbn, title, author, genre" autocomplete="off">
            </form>
            <div class="live-results"></div>	
        </div>
        <div class="book-page">
            <?php

                require("common.php");

                $ISBN13 = $_GET['ISBN13'];
                $sql = "SELECT b.ISBN10, b.ISBN13, b.author, b.title, g.genreName, b.publisher FROM books AS b, genres as g WHERE b.ISBN13 = ? AND g.genreID = b.genreID";
                $params = array( &$ISBN13 );

                $stmt = sqlsrv_query( $conn, $sql, $params);

                if( $stmt === false ){
                    die( print_r( sqlsrv_errors(), true) );
                }
                $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );
                echo '<div class="book-title">'.$row['title'].'</div><div class="book-author">'.$row['author'].'</div><div class="book-genre">'.$row['genreName'].'</div><div class="book-ISBN10">'.$row['ISBN10'].'</div><div class="book-ISBN13">'.$row['ISBN13'].'</div><div class="book-publisher">'.$row['publisher'].'</div>';
                
                sqlsrv_close( $conn );
            ?>
        </div>
    </body>
</html>