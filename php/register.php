<?php
require_once "../includes/db_config.php";
session_start();
?>
<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A saját weboldalam">
    <meta name="author" content="Patócskai István">
    <meta name="keywords" content="HTML, CSS, PHP">
    <meta name="robots" content="noindex, nofollow, nocache">
    <link rel="stylesheet" href="../css/styles.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poiret+One&family=Ubuntu&display=swap" rel="stylesheet">
	<title>Regisztrálás</title>
</head>
<body>
<div id="arrow"></div>
	<div class="main-nav-div">
		<div class="nav-div-1">
			<ul class="nav-ul">
				<li class="nav-li"><a class="nav-a" href="../index.php">KEZDŐLAP</a></li>
				<li class="nav-li"><a class="nav-a" href="pets.php">ÁLLATOK</a></li>
				<li class="nav-li"><a class="nav-a" href="../index.php">HARMADIK</a></li>
			</ul>
		</div>
		<div class="nav-div-2">
			<ul class="nav-ul">
				<li class="nav-li"><a class="profile" href="profile.php">PROFIL</a></li>
				<?php
				if(isset($_SESSION['email']))
				{
					echo "<script>
						let profile = document.getElementsByClassName('profile');
						profile[0].href = 'profile.php';
					</script>
					";
				}
				else
				{
					echo "
					<script>
						let profile = document.getElementsByClassName('profile');
						profile[0].href= 'login.php';
					</script>
					";
				}
				?>
				<li class="nav-li"><a class="nav-login-register" href="login.php">BEJELENTKEZÉS</a></li>
				<script>
						let navDiv2 = document.getElementsByClassName('nav-div-2');
						
						navDiv2[0].style.right='46px';
				</script>
				<?php 
				if(isset($_SESSION['email']))
				{
					echo "<script>
						document.getElementsByClassName('nav-login-register')[0].innerHTML = 'BEJELENTKEZVE';
					</script>";
				}
				?>
			</ul>
		</div>
	</div>

	<div class="responsive-nav-main-div">
		<label for="responsive-nav" class="responsive-nav-label"><img  class="hamburger" src="../images/hamburger1.png" alt="Responsive-NAV"></label>
		<input type="checkbox" id="responsive-nav" class="responsive-nav">
		<div class="responsive-nav-div">
			<ul class="responsive-nav-ul">
				<li class="responsive-nav-li"><a class="responsive-nav-a" href="../index.php">KEZDŐLAP</a></li>
				<li class="responsive-nav-li"><a class="responsive-nav-a" href="pets.php">ÁLLATOK</a></li>
				<li class="responsive-nav-li"><a class="responsive-nav-a" href="../index.php">HARMADIK</a></li>
				<li class="responsive-nav-li"><a class="responsive-nav-login-register" href="login.php">BEJELENTKEZÉS</a></li>
			</ul>
		</div>
	</div>


	<div class="login-div-2">
		<form class="login-form-2" action="register.php" method="post">
			<?php
			require_once "registerData.php";
			?>
			<label id="fname-label" for="fname">Keresztnév</label>
			<input class="login-input" name="fname" type="text" id="fname" placeholder="keresztnév"><br><br>
			<label id="lname-label" for="lname">Vezetéknév</label>
			<input class="login-input" name="lname" type="text" id="lname" placeholder="vezetéknév"><br><br>
			<label id="email-label" for="email">E-mail cím</label>
			<input class="login-input" name="email" type="email" id="email" placeholder="email" autocomplete="off"><br><br>
			<label id="password-label" for="password">Jelszó</label>
			<input class="login-input" name="password" type="password" id="password" placeholder="jelszó"><br><br>
			<label id="password-label" for="pw2">Jelszó ismét</label>
			<input class="login-input" name="pw2" type="password" id="pw2" placeholder="jelszo ismét"><br><br>
			<input class="login-button-2" type="submit" name="register" value="Regisztrálás">
			<input class="login-button-2" type="reset" name="reset" value="Alaphelyzet"><br><br>
			
			<label for="requirement"><p class="requirement-button">Regisztrálás feltételei</p></label>
			<input class="requirement" id="requirement" type="checkbox" name="requirement" value="Regisztrálás feltételei"><br>
			<p class="p4">Becenév & Vezetéknév: Legalább 4 betűt kell, hogy tartalmazzon.<br>
			E-mail cím: Hiteles e-mail címet adjon meg.<br>
			Jelszó: Legalább 8 karaktert kell tartalmazzon, és ugyanaz kell, hogy legyen mindkét jelszó!</p>
		</form>
	</div>
<script src="../JavaScript/javascript2.js"></script>


<a href="#arrow">
	<div class="bottom-arrow">
		<div class="arrow-top"></div>
		<div class="arrow-shape"></div>
	</div>
</a>
</body>
</html>

