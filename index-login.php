<?php
	session_start();
	if(isset($_SESSION["loggedin"])) {
		header("Location: index.php");
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Snap It</title>
		<link href="index.css" type="text/css" rel="stylesheet" />
		<script src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.0.0/prototype.js" type="text/javascript"></script>
		<script src="index.js" type="text/javascript"></script>

		<link rel="shortcut icon" type="image/x-icon" href="http://students.washington.edu/kershm/pics/favicon.ico">
		<meta name="viewport" content="width=device-width" />
	</head>
	<body>
		
		<span class="title"><img class="title" src="logo.jpg" alt="Snap It logo" /></span> <div class="title-blurb"><span> [a simple, all-purpose website for storing or blogging photos] </span></div>

		<hr>

		<div class="center">
			<?php
				$error = "";
				if(isset($_GET["notfound"])) {
					$error = "The user specified was not found.";
				} elseif(isset($_GET["incorrectpass"])) {
					$error = "The password for that user was incorrect.";
				} elseif(isset($_GET["nonmatch"])) {
					$error = "The passwords do not match";
				} elseif(isset($_GET["length"])) {
					$error = "Passwords and usernames must be between 1 and 12 characters long";
				} elseif(isset($_GET["duplicate"])) {
					$error = "That username has already been chosen.";
				} elseif(isset($_GET["badchar"])) {
					$error = "Usernames can only contain letters and numbers.";
				}
				if ($error != "") { ?>
					<p id="error"><?= $error ?></p>
			<?php } ?>
			<div class="login">
				<h3>Returning User</h3>
				<form id="loginform" action="login.php" method="post">
					<p><input id="name" name="name" type="text" size="12" autofocus="autofocus" /> <strong>User Name</strong></p>
					<p><input id="password" name="password" type="password" size="12" /> <strong>Password</strong></p>
					<p><input id="submitbutton" type="submit" value="Log in" /></p>
				</form>
			</div>
			<hr>
			<div class="login">
				<h3>New User</h3>
				<form id="loginform" action="new-login.php" method="post">
					<p><input id="name" name="name" type="text" size="12" /> <strong>User Name</strong></p>
					<p><input id="password" name="password" type="password" size="12" /> <strong>Password</strong></p>
					<p><input id="repassword" name="repassword" type="password" size="12" /> <strong>Re-enter Password</strong></p>
					<p><input id="submitbutton" type="submit" value="Log in" /></p>
				</form>
			</div>
		</div>
	</body>

</html>