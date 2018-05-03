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
                <li class="menu-button menu-right"><a class="menu-button-link" href="login.php">sign in</a></li>
                <li class="menu-button menu-right"><a class="menu-button-link" href="register.php">sign up</a></li>
                <li class="cheat"></li>
            </ul>
        </div>
        <div class="backsplash"></div>
        <div class="search">
            <ul class="search-results">
<?php
	require("common.php");
    $search = $_POST['main-search-bar'];
	$sql = "SELECT b.ISBN13, b.title, b.author, g.genreName FROM books AS b, genres as g WHERE b.title LIKE '%".$search."%' OR b.author LIKE '%".$search."%' OR b.ISBN13 = '".$search."' OR b.ISBN10 = '".$search."' OR g.genreName LIKE '%".$search."%' AND b.genreID = g.genreID";
    $params = array( &$search, &$search, &$search, &$search, &$search );
    $stmt = sqlsrv_query( $conn, $sql, $params );
    if( $stmt === false ){
        echo sqlsrv_errors();
        die( print_r( sqlsrv_errors(), true) );
    }
	while ( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		echo "<li class='search-result'><a class='search-result-link' href='result.php?ISBN=".$row['ISBN13']."'>".$row['title'].", ".$row['author'].", ".$row['genreName']."</a></li>";
        echo $row['ISBN13'];
    }
    
    sqlsrv_close( $conn );
?>
            </ul>
        </div>
</body>
</html>