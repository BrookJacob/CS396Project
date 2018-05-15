<?php
    session_start();

    require("common.php");

    $userID = $_SESSION['user']['userID'];
    $ISBN13 = $_GET['q'];
    $sql = "DELETE FROM userlibrary WHERE l.userID = ? AND l.ISBN13 = ?";
    $params = array( &$userID, &$ISBN13 );
    $stmt = sqlsrv_query( $conn, $sql, $params );
    if( $stmt === false ){
        die( print_r( sqlsrv_errors(), true) );
    }
    header("Location: library.php");
    die("Redirecting to: library.php");

?>