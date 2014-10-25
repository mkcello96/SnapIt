<?php
	session_start();

	if(!isset($_SESSION["loggedin"])) {
		header("Location: index-login.php");
	}
	
	if (!isset($_GET["user"]) || !isset($_GET["album"])) {
		header("HTTP/1.1 400 Invalid Request");
		die("An HTTP error 400 (invalid request) occurred.");
	}

	$link = mysql_connect("/*ADD YOUR DATABASE LOGIN INFO HERE/*")
			or die ("Couldn't connect");
			$db = "photos";
			mysql_select_db($db) or die("Could not select the database '" . $db . "'.  Are you sure it exists?");

	$user = $_GET["user"];
	$album = $_GET["album"];
	$user_current = $_SESSION["user"];
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Snap It</title>
		<link href="index.css" type="text/css" rel="stylesheet" />

		<script src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.0.0/prototype.js" type="text/javascript"></script>
		<script src="index.js" type="text/javascript"></script>
		
		<link rel="shortcut icon" type="image/x-icon" href="http://students.washington.edu/kershm/draw/pics/favicon.ico">
		<meta name="viewport" content="width=device-width" />
	</head>
	<body>
		<span class="title"><img class="title" src="logo.jpg" alt="Snap It logo" /></span>
		<div class="login-status">
			<p class="p-right">Welcome, <span id="currentuser"><?= $user_current ?></span></p>
			<p class="p-right"><a href="userprofile.php?user=<?= $user_current ?>">View Blog</a></p>
			<p class="p-right"><a href="logout.php">Log Out</a></p>
		</div>
		
		<hr>
		
		<div class="center">
			<h2><?= $user ?> - <?= $album ?></h2>

			<?php
				$photos = glob("users/$user/$album/*");
				for($i = 0; $i < count($photos); $i++) { 
					$current_photo = $photos[$i]; ?>
					<p><a href="<?= $current_photo ?>"><img src="<?= $current_photo ?>" alt="Photo <?= $current_photo ?>"></a></p>

					<?php
					$photo_dirs = explode("/", $current_photo);
					$current_photo = $photo_dirs[count($photo_dirs) - 1];
					$rows = mysql_query("SELECT photo, caption FROM $user WHERE photo='$current_photo'");
					if(mysql_num_rows($rows) != 0) {
						$result = mysql_result($rows, 0, "caption");
					} else {
						$result = "";
					}?>
					<p><?= $result ?></p>
		  	 <?php } ?>

			<p class="back"><a href="userprofile.php?user=<?= $user ?>"> <-- BACK </p>
		</div>
	</body>

</html>