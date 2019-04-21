<?php
	session_start();
	include("config.php");
	$name = $_SESSION["name"];
	$sql = "UPDATE user_session SET status = 1 WHERE name = '$name'";

	if ($conn -> query($sql) === TRUE){
		unset($name);
		session_destroy();
		header("location: login.php");
	} else {
		echo $conn->error;
	}

?>
