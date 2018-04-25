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
                <li class="menu-button sign-in"><a class="menu-button-link" href="../account.html">sign in</a></li>
                <li class="menu-button sign-up"><a class="menu-button-link" href="../register.php">sign up</a></li>
            </ul>
        </div>
        <div class="backsplash">
            <ul class="search-results">
<?php
	require("common.php");
    $sql = "SELECT b.title, b.author, g.genreName FROM books AS b, genres as g WHERE b.title LIKE '% ? %' OR b.author LIKE '% ? %' OR b.ISBN13 = ' ? ' OR b.ISBN10 = ' ? ' OR g.genreName LIKE '% ? %' AND b.genreID = g.genreID";
    echo $sql . "</ br>";
    $search = $_REQUEST['main-search-bar'];
    echo $search . "</ br>";
    $stmt = sqlsrv_prepare( $conn, $sql, array( &$search ));
    echo $stmt . "</ br>";
    $stmt = sqlsrv_execute( $stmt );
    echo $stmt . "</ br>";
    if( $stmt === false){
        die( print_r( sqlsrv_errors(), true) );
    }
	while ( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		echo "<li class='search-result'>".$row['title'].", ".$row['author'].", ".$row['genreName']."</li>";
	}
    $version = sqlsrv_query("@@VERSION");
    echo $version;
    sqlsrv_close( $conn );
?>
            </ul>
        </div>
</body>
</html>