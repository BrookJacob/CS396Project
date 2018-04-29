<?php
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
?>