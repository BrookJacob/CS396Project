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
            <form class="add-results" action="addBook()" method="post">
                <input class="add-results-input" type="text" placeholder="Book Title" name="title">
                <input class="add-results-input" type="text" placeholder="Author" name="author">
                <input class="add-results-input" type="text" placeholder="Genre" name="genre"><br>
                <input class="add-results-input" type="text" placeholder="publisher" name="publisher">
                <input class="add-results-input" type="text" placeholder="ISBN10" name="ISBN10">
                <input class="add-results-input" type="text" placeholder="ISBN13" name="ISBN13"><br>
                <input class="add-results-input submit" type="submit" name="submit">
            </form>
            </div>
        <?php
                require("common.php");

                function addBook(){
                    if(!empty($_POST['Book Title']) && !empty($_POST['Author']) && !empty($_POST['Genre']) && !empty($_POST['Publisher']) && !empty($_POST['ISBN10'] && $_POST['ISBN13'])) {
                        $genreName = $_POST['genre'];

                        $sql = "SELECT 1 FROM genres WHERE genreName = ?";
                        $params = array( &$genreName);
                        $stmt = sqlsrv_query( $conn, $sql, $params);
                        if( $stmt === false ){
                            die( print_r( sqlsrv_errors(), true) );
                        }
                        if ($stmt === true) {
                            $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC);
                            $genreID = $row['genreID'];
                        } else {
                            $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC );
                            $sql = "INSERT INTO genres (genreName) VAlUES (?)";
                            $params = array( &$genreName );
                            $stmt = sqlsrv_query( $conn, $sql, $parms );
                            if( $stmt === false ){
                                die( print_r( sqlsrv_errors(), true) );
                            }
                        }

                    
                    
                        $ISBN10 = $_POST['ISBN10'];
                        $ISBN13 = $_POST['ISBN13'];
                        $author = $_POST['author'];
                        $title = $_POST['title'];
                        $publisher = $_POST['publisher'];
                        $sql = "INSERT INTO books ( ISBN10, ISBN13, author, title, genreID, publisher ) VALUES ( ?, ?, ?, ?, ?, ? )";
                        $params = array( &$ISBN10, &$ISBN13, &$author, &$title, &$genreID, &$publisher );
                        $stmt = sqlsrv_query( $conn, $sql, $params );
                        if( $stmt === false ){
                            die( print_r( sqlsrv_errors(), true) );
                        } else {
                            header("Location: search.php#result?q=".$ISBN13."");
                            die("Redirecting to: search.php#result?q=".$ISBN13."");
                        }
                    } else {
                        echo 'all fields are required';
                    }
                }
                if(isset($_POST['submit'])){
                    addBooks();
                }

        ?>
    </body>
</html>