<html>
<head>
    <title>library books</title>
    <link href="../css/main.css" type="text/css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
</head>
    <body class="splash">
        <div class="menu-bar">
            <ul class="menu-buttons">
                <li class="menu-button"><a class="menu-button-link" href="../index.html">library books</a></li>
                <li class="menu-button"><a class="menu-button-link" href="../index.html#about">about</a></li>
                <li class="menu-button"><a class="menu-button-link" href="../index.html#feedback">feedback</a></li>
                <li class="menu-button sign-in"><a class="menu-button-link" href="../account.html">sign in</a></li>
                <li class="menu-button sign-up"><a class="menu-button-link" href="../register.php">sign up</a></li>
            </ul>
        </div>
        <div class="backsplash">
            <form class="login" action="register.php" method="post">
				<h>sign up</h>
				<input type="text" placeholder="username" name="username">
				<input type="text" placeholder="password">
				<input type="submit" value="submit">
			</form>
<?php
	require("common.php");
    
    /*if(!empty($_POST))
    {
        if(empty($_POST['username'])){

        };
    };*/
    
    sqlsrv_close( $conn );
?>
            </ul>
        </div>
</body>
</html>