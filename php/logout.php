<?php
    require("common.php");
    if(empty($_SESSION['user'])){
        header("Location: login.php");
        die("Redirecting to login.php");
    } else {
        unset($_SESSION['user'])
        header("Location: ../index.php");
        die("Redirecting to ../index.php");
    }

?>