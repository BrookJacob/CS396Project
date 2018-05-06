<?php
    session_start();
?>
<html>
    <head>
        <title>library books</title>
        <link href="css/main.css" type="text/css" rel="stylesheet" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Merriweather" rel="stylesheet">
    </head>
    <body>
        <div class="splash"></div>
        <div class="menu-bar">
            <ul class="menu-buttons">
                <li class="menu-button"><a class="menu-button-link" href="index.php">library books</a></li>
                <li class="menu-button"><a class="menu-button-link" href="index.php#about">about</a></li>
                <li class="menu-button"><a class="menu-button-link" href="index.php#feedback">feedback</a></li>
                <?php
                if(empty($_SESSION['user'])){
                    echo '<li class="menu-button menu-right"><a class="menu-button-link" href="php/login.php">sign in</a></li>';
                    echo '<li class="menu-button menu-right"><a class="menu-button-link" href="php/register.php">sign up</a></li>';
                    echo '<li class="cheat"></li>';
                } else {
                    echo '<li class="menu-button"><a class="menu-button-link" href="php/library.php">my library</a></li>';
                    echo '<li class="menu-button menu-right"><a class="menu-button-link" href="php/account.php">account</a></li>';
                    echo '<li class="menu-button menu-right"><a class="menu-button-link" href="php/logout.php">log out</a></li>';
                    echo '<li class="cheat"></li>';
                }
                ?>
        </div>
        <div class="searchdiv">
            <form class="main-search-bar" name="search" action="php/search.php?go" method="post">
                <input class="main-search-bar" type="text" name="main-search-bar" placeholder="isbn, title, author, genre" autocomplete="off">
            </form>
            <div class="live-results"></div>	
        </div>
        <div class="about" id="about">
			<p class="product-description">library books is a book review aggregation website that provides users with ratings for a given book from various sources on the internet. users will be able to add books to a personal virtual library and view recommendations based on their library.</p>
			<div class="team-description">
                <p>library books is currently being developed by two Whitworth University juniors.</p>
				<div class="Bridget">
                    <img src="images/bridget.jpg" />
					<p class="Bridget-Description">Bridget is a Sociology major who loves reading.</p>
				</div>
				<div class="Jacob">
                    <img src="images/BrookJacob.jpg" />
					<p class="Jacob-description">Jacob is a Computer Science major who doesn't read enough.</p>
				</div>
			</div>
        </div>
        <div class="feedback-form-container" id="feedback">
			<form class="feedback-form" action="php/feedback.php" method="post">
                <p>feedback</p>
                <input class="feedback-input" type="text" name="first" placeholder="Name"><br>
				<input class="feedback-input" type="text" name="email" placeholder="Email"><br>
				<textarea class="feedback-input" name="feedback" placeholder="Feedback"></textarea><br>
				<input class="feedback-input submit" type="submit" name="Submit" value="Submit" >
			</form>
        </div>
        <script>
            function fill(Value){
                $(".main-search-bar").val(Value);
                $(".live-results").hide();
            }
            $(document).ready(function(){
                $(".main-search-bar").keyup(function(){
                    var q = $("main-search-bar").val();
                    if(q == ""){
                        $(".live-results").html("");
                    } else {
                        $.ajax({
                            type: "POST",
                            url: "php/liveResults.php",
                            data: {
                                search: q
                            },
                            success: function(html) {
                                $(".live-results").html(html).show();
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>