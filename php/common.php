<?php
	$file = fopen("../../../LogFiles/connection.txt", "r") or die("Unable to open file!");
	$psswrd = fread($file, 11);
	fclose($file);
	
    $serverName = "lb2.database.windows.net";
	$connectionOptions = array("LB2Admin", "".$psswrd."", "lb2");
    
    //Establishes the connection
    $mysqli = new mysqli($serverName, $connectionOptions);
    if( mysqli_errno() ) {
        echo "<p class=\"hidden\">Connection established. </p>";
    } else {
        echo "Connection could not be established.";
        die( print_r( mysqli_errors(), true));
    }
?>