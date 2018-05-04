<?php
    require("common.php");
    if(isset($_POST['main-search-bar'])) {
        $q = $_POST['main-search-bar'];
        $sql = "SELECT b.title, b.author, g.genreName FROM books AS b, genres AS g WHERE b.title LIKE '%?%' OR b.author LIKE '%?%' OR g.genreName LIKE '%?%' OR ISBN10 = '?' OR ISBN13 = '?' AND g.genreID = b.genreID";
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