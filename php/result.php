<html>
    <head>
        <title>library books</title>
        <link href="../css/main.css" type="text/css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
    </head>
    <body class="splash">
        <div class="menu-bar">
            <ul class="menu-buttons">
                <li class="menu-button"><a class="menu-button-link" href="../index.html">library books</a></li>
                <li class="menu-button"><a class="menu-button-link" href="../index.html#about">about</a></li>
                <li class="menu-button"><a class="menu-button-link" href="../index.html#feedback">feedback</a></li>
                <li class="menu-button menu-right"><a class="menu-button-link" href="php/login.php">sign in</a></li>
                <li class="menu-button menu-right"><a class="menu-button-link" href="php/register.php">sign up</a></li>
                <li class="cheat"></li>
        </div>
        <div class="book-page">
            <?php

                require("common.php");

                $ISBN13 = $_GET['ISBN13'];
                echo $ISBN13;
                $sql = "SELECT b.ISBN10, b.ISBN13, b.author, b.title, g.genreName FROM books AS b, genres as g WHERE b.ISBN13 = '".$ISBN13."' AND g.genreID = b.genreID";
                $params = array( &$ISBN13 );

                $stmt = sqlsrv_query( $conn, $sql, $params);

                if( $stmt === false ){
                    echo sqlsrv_errors();
                    die( print_r( sqlsrv_errors(), true) );
                }
                $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );
                echo '<div class="book-title">'.$row['title'].'</div><div class="book-author">'.$row['author'].'</div><div class="book-genre">'.$row['genreName'].'</div><div class="book-ISBN10">'.$row['ISBN10'].'</div><div class="book-ISBN13">'.$row['ISBN13'].'</div><div class="book-publisher">'.$row['publisher'].'</div>';

            ?>
        </div>
    </body>
</html>