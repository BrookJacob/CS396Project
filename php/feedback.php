<?php 
	$f = fopen("feedback.txt", "a+");
	$name = $_POST["first"];
	$email = $_POST["email"];
	$feedback = $name . "\n" . $email . "\n" . date("m/d/Y") . "\n" . $_POST["feedback"] . "\n\n";
	echo $feedback;
	fwrite($f, $feedback);
	fclose($f);
	
?>