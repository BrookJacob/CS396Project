<html>
<head>
    <title>library books</title>
    <link href="../css/main.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
</head>
    <body class="splash">
        <div class="menu-bar">
            <ul class="menu-buttons">
                <li class="menu-button"><a class="menu-button-link" href="index.html">library books</a></li>
                <li class="menu-button"><a class="menu-button-link" href="library.html">my library</a></li>
                <li class="menu-button"><a class="menu-button-link" href="index.html#about">about</a></li>
                <li class="menu-button"><a class="menu-button-link" href="index.html#feedback">feedback</a></li>
            </ul>
        </div>
<?php
	$file = fopen("../../../LogFiles/connection.txt", "r") or die("Unable to open file!");
	$psswrd = fread($file, 11);
	fclose($file);
	
    $serverName = "lb2.database.windows.net";
	$connectionOptions = array( "Database" => "librarybooks", "Uid" => "LB2Admin", "PWD" => "".$psswrd."");
    
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if( $conn ) {
        echo "Connection established. <br />";
    } else {
        echo "Connection could not be established. <br />";
        die( print_r( sqlsrv_errors(), true));
    }
    $search = $_REQUEST['main-search-bar'];
	$sql = "SELECT b.ISBN, b.title, b.author, g.genreName FROM books AS b, genre as G WHERE b.title LIKE '%". $search . "%' OR b.author LIKE '%". $search . "%' OR b.ISBN LIKE '%". $search . "%' OR g.genreName LIKE '%". $search . "%' AND b.genreID = g.genreID";
    $stmt = sqlsrv_query( $conn, $sql);
	while ( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		echo $row['ISBN'].", ".$row['title'].", ".$row['author'].", ".$row['genreName']."<br />";
	}
    
    sqlsrv_close( $conn );
?>
</body>
</html>