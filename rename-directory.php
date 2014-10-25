<?php
	header("Content-Type: text/plain");
	if (!isset($_POST["name"]) || !isset($_POST["newname"]) || !isset($_POST["place"])) {
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
	$old_dir = $_POST["name"];
	$new_dir = $_POST["newname"];
	$old_dir = "users/" . $place . $old_dir;
	$new_dir = "users/" . $place . $new_dir;

	if(is_dir($old_dir) && !is_dir($new_dir)) {
		rename($old_dir, $new_dir);
		print $new_dir;
	} else {
		print "error";
	}
?>


