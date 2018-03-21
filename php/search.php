<?php
     $serverName = "librarybooks.database.windows.net";
     $connectionOptions = array(
         "Database" => "librarybooks",
         "Uid" => "LBADMIN",
         "PWD" => "Pirate88"
     );
     //Establishes the connection
     $conn = sqlsrv_connect($serverName, $connectionOptions);
     $search = $_POST["search"];
     $tsql = "SELECT b.Title FROM books b WHERE b.Title LIKE '%" . $search . "%'";
     $getResults = sqlserv_query($conn, $tsql);
     echo ("Reading data from table" . PHP_EOL);
     if ($getResults == FALSE)
        echo (sqlsrv_errors());
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
        echo ($row['Title']. " " . PHP_EOL);
    }
    sqlsrv_free_stmt($getResults);
?>