<?php
    $serverName = "librarybooks.database.windows.net";
    $connectionOptions = array(
        "Database" => "librarybooks",
        "Uid" => "LBADMIN",
        "PWD" => "Pirate88"
     );
    //Establishes the connection
    $conn = sqlsrv_connect($serverName, $connectionOptions);
    if( $conn ) {
        echo "Connection established. <br />";
    } else {
        echo "Connection could not be established. <br />";
        die( print_r( sqlsrv_errors(), true));
    }
    $search = $_POST['search'];
	$sql = "SELECT b.ISBN, b.title, b.author, g.genreName FROM books AS b, genre as G WHERE title LIKE '%". $search . "%' AND b.genreID = g.genreID";
    $stmt = sqlsrv_query( $conn, $sql);
	while ( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {
		echo $row['ISBN'].", ".$row['title'].", ".$row['author'].", ".$row['genre']."<br />";
	}
    
    sqlsrv_close( $conn );
?>