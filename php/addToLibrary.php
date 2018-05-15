<?php
    session_start();

    require("Common.php");

    $userID = $_SESSION['user']['userID'];
    $ISBN13 = $_GET['q'];
    $sql = "INSERT INTO userlibrary ( userID, ISBN13 ) VALUES ( ?, ? )";
    $params = array( &$userID, &$ISBN13 );
    $stmt = sqlsrv_query( $conn, $sql, $params );
    if( $stmt === false ){
        die( print_r( sqlsrv_errors(), true) );
    }
    header("Location: library.php");
    die("Redirecting to: library.php");

?>