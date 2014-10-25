<?php
	header("Content-Type: application/json");
	if (!isset($_POST["user"])) {
		header("HTTP/1.1 400 Invalid Request");
		die("An HTTP error 400 (invalid request) occurred.");
	}
	$user = $_POST["user"];

	$dirs = glob("users/$user/*");

	for($i = 0; $i < count($dirs); $i++) {
		$arr = explode("/", $dirs[$i]);
	    $dirs[$i] = $arr[count($arr) - 1];
	}

	echo json_encode($dirs);
?>