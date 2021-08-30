<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin</title>
	<style>
	.wrapper{
		width: 500px;
		position: absolute;
		left: 50%;
		transform: translateX(-50%);
		top: 150px;
		padding: 15px;
		background-color: #0049cc;
		border-radius: 20px;
		box-shadow: 0 0 10px #0049cc;
	}
	
	html{
	height: 100%;
	}
	
	body {
	margin: 0px;
	padding: 0px;
	background-image: linear-gradient(#03a, #0a3);
	height: 100%;
	width: 100%;
	background-repeat: no-repeat;
	background-attachment: fixed;
	color: #fff;
	font-family: 'Ubuntu', sans-serif;
	}

	#nm, #pw{
		background-color: #007bff;
		color: #fff;
	}

	@media screen and (max-width: 520px) {
		.wrapper{
			width: 90vw;
		}
	}

	</style>
</head>
<body>
<div class="wrapper">
	<div class="form-group">
		<form method="post" action="admin.php">
			<label for="nm"><b>Adminisztrátor neve</b></label><br>
			<input type="text" name="name" id="nm" class="form-control"><br>
			<label for="pw"><b>Jelszó</b></label><br>
			<input type="password" class="form-control" name="password" id="pw"><br>
			<button type="submit" class="btn btn-primary btn-lg btn-block" name="login">Bejelentkezés</button>
		</form>
	</div>
</div>

</body>
</html>
<?php
if(isset($_POST["login"]))
{
	$adminName = $_POST["name"];
	$pw = $_POST["password"];
	if($adminName == "admin" && $pw == "admin123")
	{
		header ("location: adminLoggedIn.php");
	}
}



?>
