<?php
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
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poiret+One&family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
    <title>Bejelentkezés</title>
</head>
<body>
<div id="arrow"></div>
	<div class="main-nav-div">
		<div class="nav-div-1">
			<ul class="nav-ul">
				<li class="nav-li"><a class="nav-a" href="../index.php">KEZDŐLAP</a></li>
				<li class="nav-li"><a class="nav-a" href="pets.php">ÁLLATOK</a></li>
				<li class="nav-li"><a class="nav-a" href="../index.php">KEDVENCEK</a></li>
				<li class="nav-li"><a class="nav-a" href="msg.php">ÜZENETEK</a></li>
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
				<?php 
				if(isset($_SESSION['email']))
				{
					echo "<script>
						document.getElementsByClassName('nav-login-register')[0].innerHTML = 'BEJELENTKEZVE';
					</script>";
				}
				?>
				<li class="nav-li"><a class="nav-logout" href="login.php">KIJELENTKEZÉS</a></li>
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
				<li class="responsive-nav-li"><a class="responsive-nav-a" href="favorites.php">KEDVENCEK</a></li>
				<li class="responsive-nav-li"><a class="responsive-nav-a" href="msg.php">ÜZENETEK</a></li>
				<li class="responsive-nav-li"><a class="responsive-nav-a prf" href="profile.php">PROFIL</a></li>
				<?php
				if(isset($_SESSION['email']))
				{
					echo "<script>
						let prf = document.getElementsByClassName('prf');
						prf[0].href = 'profile.php';
					</script>
					";
				}
				else
				{
					echo "
					<script>
						let prf = document.getElementsByClassName('prf');
						prf[0].href= 'login.php';
					</script>
					";
				}
				?>
				<li class="responsive-nav-li"><a class="responsive-nav-login-register" href="login.php">BEJELENTKEZÉS</a></li>
			</ul>
		</div>
	</div>



<div class="login-div">
		<form class="login-form l2" action="login.php" method="POST">
			<?php 
			require_once("loginData.php");
			?>	
		<div class="input-fields"> 
			<?php
			if(isset($_SESSION['email']))
			{
				echo "
				<script>
					document.querySelectorAll('.input-fields')[0].style.display = 'none';
					document.querySelector('.login-div').classList.add('login-div8');
					document.querySelector('.login-div').classList.remove('login-div');
					document.querySelector('.login-form').classList.remove('login-form');
					document.querySelector('.l2').classList.add('login-form6');
				</script>
				";
			}
			else if(!isset($_SESSION['email']))
			{
				echo "
				<script>
					document.getElementsByClassName('input-fields')[0].style.display = 'block';
					document.querySelector('.login-div').classList.remove('login-div8');
					document.querySelector('.login-div').classList.add('login-div');
					document.querySelector('.login-form').classList.add('login-form');
					document.querySelector('.login-form').classList.remove('login-form6');
				</script>
				";
			}
			?>
			<label id="email-label" for="email">E-mail</label>
			<input class="login-input" name="email" type="text" id="email" placeholder="e-mail"><br><br>
			<label id="password-label" for="pw">Jelszó</label>
			<input class="login-input" name="password" type="password" id="pw" placeholder="jelszó"><br><br>
			<input class="login-button" name="bejelentkezes" id="sb" type="submit" value="Bejelentkezés">
			<input class="login-button" type="reset" name="reset2" value="Alaphelyzet">
			<br><br><br>
			<a class="forgot-password" href="password.php">Elfelejtette a jelszavát?</a>
			<a class="register-a" href="register.php">Még nem regisztrált?</a>
		</div>
		</form>
	</div>

<a href="#arrow">
	<div class="bottom-arrow">
		<div class="arrow-top"></div>
		<div class="arrow-shape"></div>
	</div>
</a>
</body>
</html>

