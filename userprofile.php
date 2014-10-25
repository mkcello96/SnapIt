<?php
	session_start();
	
	if(!isset($_SESSION["loggedin"])) {
		header("Location: index-login.php");
	}

	if (!isset($_GET["user"])) {
		header("HTTP/1.1 400 Invalid Request");
		die("An HTTP error 400 (invalid request) occurred.");
	}

	$user = $_GET["user"];
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
			<h2><?= $user ?>'s photo albums</h2>

			<?php
				$albums = glob("users/$user/*");
				for($i = 0; $i < count($albums); $i++) { 
					$arr = explode("/", $albums[$i]);
					$a = $arr[count($arr) - 1];
					?>
					<p><a href="useralbum.php?user=<?= $user ?>&amp;album=<?= $a ?>"><?= $a ?></a></p>
					<!--img src="<?= $photos[$i] ?>" alt="Photo <?= $photos[$i] ?>" height="50"-->
		  <?php }
			?>

			<p class="back"><a href="index.php"> <-- BACK </p>
		</div>
	</body>

</html>