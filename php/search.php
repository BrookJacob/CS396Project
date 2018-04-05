<html>
	<head>
	</head>
	<body>
	hello
	</body>
</html>
<?php
	$file = fopen("../../../data/connection.txt", "r") or die("Unable to open file!");
	$psswrd = fread($file, 8);
	fclose($file);
	
    $serverName = "librarybooks.database.windows.net";
	$connectionOptions = array( "Database" => "librarybooks", "Uid" => "LBAdmin", "PWD" => "".$psswrd."");
    
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if( $conn ) {
        echo "Connection established. <br />";
    } else {
        echo "Connection could not be established. <br />";
        die( print_r( sqlsrv_errors(), true));
    }
    $search = $_REQUEST['main-search-bar'];
	$sql = "SELECT b.ISBN, b.title, b.author, g.genreName FROM books AS b, genre as G WHERE title LIKE '%". $search . "%' AND b.genreID = g.genreID";
    $stmt = sqlsrv_query( $conn, $sql);
	while ( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		echo $row['ISBN'].", ".$row['title'].", ".$row['author'].", ".$row['genreName']."<br />";
	}
    
    sqlsrv_close( $conn );
?>