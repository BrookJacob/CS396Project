<?php
     $serverName = "librarybooks.database.windows.net";
     $connectionOptions = array(
         "Database" => "librarybooks",
         "Uid" => "LBADMIN",
         "PWD" => "Pirate88"
     );
     //Establishes the connection
     $conn = sqlsrv_connect($serverName, $connectionOptions);
     if($conn)
         echo "Connected!"
?>