<?php
    require("common.php");
    if(isset($_POST['main-search-bar'])) {
        $q = $_POST['main-search-bar'];
        $sql = "SELECT b.title, b.author, g.genreName FROM books AS b, genres AS g WHERE b.title LIKE '%?%' OR b.author LIKE '%?%' OR g.genreName LIKE '%?%' OR ISBN10 = '?' OR ISBN13 = '?' AND g.genreID = b.genreID";
        $params = array( &$q );
        $stmt = sqlsrv_query( $conn, $sql, $params);

        if ($stmt == false){
            echo sqlsrv_errors();
            die( print_r( sqlsrv_errors(), true) );
        }
    }
?>