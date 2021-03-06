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
        <div class="results-search-bar">
            <form class="main-search-bar" name="search" action="search.php?go" method="post">
                <input class="main-search-bar" type="text" name="main-search-bar" placeholder="isbn, title, author, genre" autocomplete="off">
            </form>	
        </div>
        <div class="search">
            <ul class="search-results">
<?php
	require("common.php");
    $search = $_POST['main-search-bar'];
    $likeSearch = '%'.$search.'%';
	$sql = "SELECT b.ISBN10, b.ISBN13, b.title, b.author, g.genreName FROM books AS b, genres as g WHERE (b.title LIKE ? OR b.author LIKE ? OR b.ISBN13 = ? OR b.ISBN10 = ? OR g.genreName LIKE ?) AND b.genreID = g.genreID";
    $params = array( &$likeSearch, &$likeSearch, &$search, &$search, &$likeSearch );
    $stmt = sqlsrv_query( $conn, $sql, $params );
    if( $stmt === false ){
        die( print_r( sqlsrv_errors(), true) );
    }
	while ( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
            echo '<li class="search-result"><a class="search-result-link" href="result.php?ISBN13='.$row['ISBN13'].'">'.$row['title'].', '.$row['author'].', '.$row['genreName'].'</a></li>';
    }
    
    sqlsrv_close( $conn );
?>
                <li class="addBooks"><p>can't find what you're looking for?</p><a class="search-more-options" href="addBooks.php">add a book</a><li>
            </ul>
        </div>
       
</body>
</html>