<?php 
	$f = fopen("feedback.txt", "a+");
	$name = $_POST["first"];
	$email = $_POST["email"];
	$date = $_POST["date"];
	$feedback = $name . "\n" . $email . "\n" . $date . "\n" . $_POST["feedback"] . "\n\n";
	echo $feedback;
	fwrite($f, $feedback);
	fclose($f);
	
?>