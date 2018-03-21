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
     $tsql = "SELECT title FROM books WHERE title LIKE '%" . $search . "%'";
     $getResults = sqlserv_query($conn, $tsql);
     echo ("Reading data from table" . PHP_EOL);
     if ($getResults == FALSE)
        echo ("help");
    while ($row = sqlsrv_fetch_array($getResults, SQLSRV_FETCH_ASSOC)) {
        echo ($row['title']. " " . PHP_EOL);
    }
    echo $search;
    echo $tsql;
    sqlsrv_free_stmt($getResults);
?>