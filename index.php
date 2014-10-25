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
			<h2>Upload photos</h2>
			<form action="add-photos.php"
			      method="post" enctype="multipart/form-data">
			  <h4>1) Choose file</h4>
			  <input type="file" name="photo" /><br>
			  <h4>2) Choose album [<a href="manage-blog.php">click here to add/delete albums</a>]</h4>
			  <span id="albumlist">
			  <?php
			  	$user = strtolower($user);
				$albums = glob("users/$user/*");
				for($i = 0; $i < count($albums); $i++) { 
					$arr = explode("/", $albums[$i]);
					$a = $arr[count($arr) - 1];
					?>
					<label><input type="radio" name="directory" value="<?= $a ?>" /><?= $a ?></label><br>
			  <?php }
				?>
			</span>
				<h4>3) Add a caption (optional)</h4>
			 	Caption: <input type="text" name="caption" id="caption"/><br>
			  <!--label><input type="radio" name="album" value="newalbum"/>Create new album:
			  <input type="text" name"albumname"/></label--> 
			  <h4>4) Upload</h4>
			  <input type="submit" value="Upload!"/>
			</form>

			<hr>

			<h2>View user albums</h2>

				<?php
					$users = glob("users/*");
					for($i = 0; $i < count($users); $i++) { 
						$arr = explode("/", $users[$i]);
						$u = $arr[count($arr) - 1];
						?>
						<p><a href="userprofile.php?user=<?= $u ?>"><?= $u ?></a></p>
						<!--img src="<?= $photos[$i] ?>" alt="Photo <?= $photos[$i] ?>" height="50"-->
			  <?php }
				?>
		</div>
		<span id="pic-feedback" style="display:none"><?= $_GET["photo"] ?></span>
	</body>

</html>