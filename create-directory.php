<?php
	header("Content-Type: text/plain");
	if (!isset($_POST["name"]) || !isset($_POST["place"])) {
		header("HTTP/1.1 400 Invalid Request");
		die("An HTTP error 400 (invalid request) occurred.");
	}

	$place = $_POST["place"];
	if($place != "") {
		session_start();
		$user = $_SESSION["user"];
		$user = strtolower($user);
		$place = $user . "/";
	}
	$new_dir = $_POST["name"];
	$dir = "users/" . $place . $new_dir;

	if(!is_dir($dir)) {
		if(mkdir($dir)) {
			print $new_dir;
		} else {
			print "error";
		}
	}

?>


