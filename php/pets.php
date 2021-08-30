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
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Poiret+One&family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>	
	<title>Állat örökbefogadás</title>
</head>
<body>
<div id="arrow"></div>
	<div class="main-nav-div">
		<div class="nav-div-1">
			<ul class="nav-ul">
				<li class="nav-li"><a class="nav-a" href="../index.php">KEZDŐLAP</a></li>
				<li class="nav-li"><a class="nav-a" href="pets.php">ÁLLATOK</a></li>
				<li class="nav-li"><a class="nav-a" href="favorites.php">KEDVENCEK</a></li>
				<li class="nav-li"><a class="nav-a" href="msg.php">ÜZENETEK</a></li>
			</ul>
		</div>
		<div class="nav-div-2">
			<ul class="nav-ul-2">
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
	<div class="search-div">
		<form method="post" action="pets.php" class="searchForm">
		<label class="search-lbl" for="search">Keresés</label>
		<input type="text" id="search" name="srchInput" value="">
		<button class="btn1" name="searchSubmit">
			<div class="search-button">Keresés</div>
	</div>
		</button>
		</form>
	</div><div class="margin"></div>
	<br><br><br>
<div class="advertisement-main-div">
<?php
	require_once("petsPHP.php");
	
?>
</div>	


<a href="#arrow">
	<div class="bottom-arrow">
		<div class="arrow-top"></div>
		<div class="arrow-shape"></div>
	</div>
</a>
<?php
if(isset($_SESSION["email"]))
{
	echo"
	<script>
	let ac = document.querySelectorAll('.activeOrNot2');
	let pet = document.querySelectorAll('.pet');
	let starimg = document.querySelectorAll('.star-img');
	let petCap = document.querySelectorAll('.pet-advertisement-caption');
	let img1 = document.querySelectorAll('.img1');
	console.log(ac[0]);

	for(let i = 0; i<ac.length; i++)
	{
		if(ac[i].innerHTML == 'Örökbefogadott')
		{
			ac[i].style.color='#f05';
			pet[i].style.backgroundColor='#54626F';
			petCap[i].style.marginTop='30px';
			img1[i].style.filter='grayscale(100%)';
			starimg[i].style.display='none';
		}
		else if(ac[i].innerHTML == 'Elérhető')
		{
			ac[i].style.color='#cf0';
		}
	}
	</script>
	";
}
else if(!isset($_SESSION["email"]))
{
	echo"
	<script>
	let ac = document.querySelectorAll('.activeOrNot2');
	let pet = document.querySelectorAll('.pet');
	let starimg = document.querySelectorAll('.star-img');
	let petCap = document.querySelectorAll('.pet-advertisement-caption');
	let img1 = document.querySelectorAll('.img1');
	console.log(ac[0]);

	for(let i = 0; i<ac.length; i++)
	{
		if(ac[i].innerHTML == 'Örökbefogadott')
		{
			ac[i].style.color='#f05';
			pet[i].style.backgroundColor='#54626F';
			petCap[i].style.marginTop='30px';
			img1[i].style.filter='grayscale(100%)';
		}
		else if(ac[i].innerHTML == 'Elérhető')
		{
			ac[i].style.color='#cf0';
			petCap[i].style.marginTop='30px';
		}
	}
	</script>
	";
}
?>

<script src="../JavaScript/ajaxSearch.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>

