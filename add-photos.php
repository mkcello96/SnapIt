<?php

	if (!isset($_POST["directory"]) || !isset($_POST["caption"])) {
		header("Location: index.php?photo=directory");
		die();
	}

	$directory = $_POST["directory"];

	if($directory == "") {
		header("Location: index.php?photo=directory");
		die();
	}

	$link = mysql_connect("/*ADD YOUR DATABASE LOGIN INFO HERE/*")
				or die ("Couldn't connect");
				$db = "photos";
				mysql_select_db($db) or die("Could not select the database '" . $db . "'.  Are you sure it exists?");

	session_start();
	$user = $_SESSION["user"];
	$user = strtolower($user);

	$caption = $_POST["caption"];

	$filename =  $_FILES["photo"]["name"];


	if(is_dir("users/$user/$directory")) {
		if (is_uploaded_file($_FILES["photo"]["tmp_name"])) {
	  		move_uploaded_file($_FILES["photo"]["tmp_name"], "users/$user/$directory/$filename");
	  		
	  		mysql_query("CREATE TABLE IF NOT EXISTS $user (id INT NOT NULL PRIMARY KEY AUTO_INCREMENT, photo VARCHAR(255), caption VARCHAR(1000))");
			mysql_query("INSERT INTO $user (photo, caption) VALUES('$filename','$caption')");
	  		//print "Saved uploaded file as $directory/$filename\n";
	  		header("Location: index.php?photo=success");
		} else {
			//print "Error";
			header("Location: index.php?photo=file");
		}
	} else {
		die("users/$user/$directory does not exist");
	}
?>