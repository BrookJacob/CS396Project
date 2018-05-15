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
        <div class="add-result">
            <form class="add-results" action="addBooks.php" method="post">
                <input class="add-results-input" type="text" placeholder="book title" name="title">
                <input class="add-results-input" type="text" placeholder="author" name="author">
                <input class="add-results-input" type="text" placeholder="genre" name="genre"><br>
                <input class="add-results-input" type="text" placeholder="publisher" name="publisher">
                <input class="add-results-input" type="text" placeholder="ISBN10" name="ISBN10">
                <input class="add-results-input" type="text" placeholder="ISBN13" name="ISBN13"><br>
                <input class="add-results-input submit" type="submit" name="submit">
            </form>
            </div>
        <?php
                require("common.php");

                function addBooks() {

                    if(empty($_POST['title']) && empty($_POST['author']) && empty($_POST['genre']) && empty($_POST['publisher']) && empty($_POST['ISBN10']) && empty($_POST['ISBN13'])) {
                        echo 'all fields are required';
                    } else {
                        $title = trim($_POST['title']);
                        $author = trim($_POST['author']);
                        $genre = trim($_POST['genre']);
                        $publisher = trim($_POST['publisher']);
                        $ISBN10 = trim($_POST['ISBN10']);
                        $ISBN13 = trim($_POST['ISBN13']);

                        $sql = "SELECT * FROM genres AS g WHERE g.genreName = ?";
                        echo 'i get this far ';
                        echo $genre;
                        echo $conn;
                        $params = array( &$genre );
                        $stmt = sqlsrv_query( $GLOBALS['conn'], $sql, $params );
                        if( $stmt === false ) {
                            die( print_r( sqlsrv_errors(), true) );
                        }
                        $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );
                        if($row) {
                            $genreID = $row['genreID'];
                            echo 'its me';
                            $sql = "INSERT INTO books ( ISBN10, ISBN13, author, title, genreID, publisher ) VALUES ( ?, ?, ?, ?, ?, ? )";
                            $params = array( &$ISBN10, &$ISBN13, &$author, &$title, &$genreID, &$publisher );
                            $stmt = sqlsrv_query( $GLOBALS['conn'], $sql, $params );
                        } else {
                            echo 'im in here';
                            $sql = "INSERT INTO genres ( genreName ) VALUES ( ? ); SELECT genreID FROM genres WHERE genreName = ?";
                            $params = array( &$genre, &$genre );
                            $stmt = sqlsrv_query( $GLOBALS['conn'], $sql, $params );
                            if( $stmt === false ) {
                                die( print_r( sqlsrv_errors(), true) );
                            }
                            $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );
                            $genreID = $row['genreID'];
                            $sql = "INSERT INTO books ( ISBN10, ISBN13, author, title, genreID, publisher ) VALUES ( ?, ?, ?, ?, ?, ? )";
                            $params = array( &$ISBN10, &$ISBN13, &$author, &$title, &$genreID, &$publisher );
                            $stmt = sqlsrv_query( $GLOBALS['conn'], $sql, $params );
                        }
                    }
                }
                if(isset($_POST['submit'])) {
                    addBooks();
                }
        ?>
    </body>
</html>