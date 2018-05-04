<?php
    require("common.php");
    $q = $_GET['q'];
    $sql = "SELECT b.title, b.author, g.genreName FROM books AS B, genres AS g WHERE b.title = '%?%' OR b.author = '%?%' OR g.genreName = '%?%' OR b.ISBN10 = '?' OR b.ISBN13 = '?' AND b.genreID = g.genreID";
    $params = array( &$q );

    $stmt = sqlsrv_query( $conn, $sql, $params);
    if( $stmt == false){
        echo sqlsrv_errors();
        die( print_r( sqlsrv_errors(), true) );
    }
    echo 'hello';
?>