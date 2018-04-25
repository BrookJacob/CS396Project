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
    $search = $_REQUEST['main-search-bar'];
	$sql = "SELECT b.title, b.author, g.genreName FROM books AS b, genres as g WHERE b.title LIKE '%". $search . "%' OR b.author LIKE '%" . $search . "%' OR b.ISBN13 = '" . $search . "' OR g.genreName LIKE '%" . $search . "%' AND b.genreID = g.genreID";
    $stmt = sqlsrv_query( $conn, $sql );
	while ( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		echo "<li class='search-result'>".$row['title'].", ".$row['author'].", ".$row['genreName']."</li>";
	}
    
    sqlsrv_close( $conn );
?>
            </ul>
        </div>
</body>
</html>