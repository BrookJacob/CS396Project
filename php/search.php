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
                <li class="menu-button sign-in"><a class="menu-button-link" href="account.html">sign in</a></li>
                <li class="menu-button sign-in"><a class="menu-button-link" href="account.html">sign up</a></li>
            </ul>
        </div>
        <div class="search-return">
            <ul class="search-results">
                <li class="search-result">1984, George Orwell, Science Fiction</li>
                <li class="search-result">Martian Chronicles, Ray Bradbury, Science Fiction</li>
<!--<?php
	$file = fopen("../../../LogFiles/connection.txt", "r") or die("Unable to open file!");
	$psswrd = fread($file, 11);
	fclose($file);
	
    $serverName = "lb2.database.windows.net";
	$connectionOptions = array( "Database" => "lb2", "Uid" => "LB2Admin", "PWD" => "".$psswrd."");
    
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if( $conn ) {
        echo "<p class=\"hidden\">Connection established. </p>";
    } else {
        echo "Connection could not be established.";
        die( print_r( sqlsrv_errors(), true));
    }
    $search = $_REQUEST['main-search-bar'];
	$sql = "SELECT b.title, b.author, g.genreName FROM books AS b, genres as g WHERE b.title LIKE '%". $search . "%' OR b.author LIKE '%" . $search . "%' OR b.ISBN13 = '" . $search . "' OR g.genreName LIKE '%" . $search . "%' AND b.genreID = g.genreID";
    $stmt = sqlsrv_query( $conn, $sql);
	while ( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		echo "<li class='search-result'>".$row['title'].", ".$row['author'].", ".$row['genreName']."</li>";
	}
    
    sqlsrv_close( $conn );
?>-->
            </ul>
        </div>
</body>
</html>