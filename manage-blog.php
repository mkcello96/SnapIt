<?php
	session_start();
	$link = mysql_connect("/*ADD YOUR DATABASE LOGIN INFO HERE/*")
				or die ("Couldn't connect");
				$db = "photos";
				mysql_select_db($db) or die("Could not select the database '" . $db . "'.  Are you sure it exists?");
	if(!isset($_SESSION["loggedin"])) {
		header("Location: index-login.php");
	}
	$user = $_SESSION["user"];
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
			<p class="p-right">Welcome, <span id="currentuser"><?= $user ?></span></p>
			<p class="p-right"><a href="userprofile.php?user=<?= $user ?>">View Blog</a></p>
			<p class="p-right"><a href="logout.php">Log Out</a></p>
		</div>

		<hr>

		<div class="center">
			<h2>Manage Albums</h2>
			
			  <ul id="albumlist">
			  <?php
			  	$user = strtolower($user);
				$albums = glob("users/$user/*");
				for($i = 0; $i < count($albums); $i++) { 
					$arr = explode("/", $albums[$i]);
					$a = $arr[count($arr) - 1];
					?>
					<li><?= $a ?> 
						<button type="button" value="<?= $a ?>" class="renamebutton">rename</button>
						<button type="button" value="<?= $a ?>" class="deletebutton">delete</button>
					</li>
			  <?php }
				?>
			</ul>
			<div id="newalbum">
				<input type="text" name="albumname" id="albumname"/>
				<button type="button" id="addalbum">Make new album</button>
			</div>
				
			 <p class="back"><a href="index.php"> <-- BACK </p>
	</body>

</html>