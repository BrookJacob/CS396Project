<?php
    require("common.php");
    if(isset($_POST['main-search-bar'])) {
        $q = $_POST['main-search-bar'];
        $sql = "SELECT b.title, b.author, g.genreName FROM books AS b, genres AS g WHERE b.title LIKE '%".$q."%' OR b.author LIKE '%".$q."%' OR g.genreName LIKE '%".$q."%' OR ISBN10 = '".$q."' OR ISBN13 = '".$q."' AND g.genreID = b.genreID";
        $params = array( &$q );
        $stmt = sqlsrv_query( $conn, $sql, $params);
        echo sqlsrv_errors();

        if ($stmt == false){
            echo sqlsrv_errors();
            die( print_r( sqlsrv_errors(), true) );
        }
        echo '<ul>';
        while ($row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC )){
            ?>
            <li onclick='fill("<?php echo $row['title']; ?>")'>
            <a>
            <?php echo $row['title']; ?>
        </li></a>
        <?php
        }
    }
?>
</ul>