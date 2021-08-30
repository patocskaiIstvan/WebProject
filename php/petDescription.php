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
    <title>Állat leírása</title>
</head>
<body>
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
				<li class="responsive-nav-li"><a class="responsive-nav-a" href="index.php">KEZDŐLAP</a></li>
				<li class="responsive-nav-li"><a class="responsive-nav-a" href="pets.php">ÁLLATOK</a></li>
				<li class="responsive-nav-li"><a class="responsive-nav-a" href="index.php">HARMADIK</a></li>
				<li class="responsive-nav-li"><a class="responsive-nav-login-register" href="login.php">BEJELENTKEZÉS</a></li>
			</ul>
		</div>
	</div>
	<br><br><br>
<div class="pet-description-main-div">
<?php
		$id=$_GET["id"];
		$sqlCommand2="SELECT * FROM pets INNER JOIN category ON pets.categoryId = category.categoryId INNER JOIN status s ON pets.statusId = s.statusId WHERE id = :ID ";
		$sqlQuery2=$connect->prepare($sqlCommand2);
		$sqlQuery2->bindValue(":ID",$id);
		$sqlQuery2->execute();
		
	while($row = $sqlQuery2->fetch(PDO::FETCH_ASSOC)) 
	{
		$type=$row["type"];
		$status=$row["status"];
		$petAge=$row["age"];
		$image=$row["image"];
		$description=$row["description"];
		$isActive = $row["active"];
		$email = $row["email"];
		$active = $row["active"];
		$desc = $row["description"];
		if($active == 0)
		{
			$isActive = "Örökbefogadott";
		}
		else if($active == 1)
		{
			$isActive = "Elérhető";
		}

    echo "
		<div class='pet-description'>
		<div class='pet-description-caption'>
			<img class='img2' src='../images/animals/$image' alt='hírdetés'>
			<div class='caption'>
				<div class='caps'>
					<b>Hírdető</b>: <br><br>
					<b>Állat fajtája</b>: <br><br>
					<b>Állapota</b>: <br><br>
					<b>Életkor</b>: <br><br>
					<b>Leírás</b><br><br>
				</div>
				<div class='attr'>";
				if(empty($email))
				{
					$emptyMail = "[ADMIN]";
					echo "
						$emptyMail<br><br>
						$type<br><br>
						$status<br><br>
						$petAge<br><br>
						<span class='animal-desc'>$desc</span>
					";
				}
				else
				{
					echo "
						$email<br><br>
						$type<br><br>
						$status<br><br>
						$petAge<br><br>
						<span class='animal-desc'>$desc</span>
					";
				}
				echo "
				</div>
			</div>
			<div class='activeOrNot'>$isActive</div>
		</div>
		</div>";
	}
?>

</div>	
<script>
let ac = document.querySelectorAll(".activeOrNot");
console.log(ac[0]);

for(let i = 0; i<ac.length; i++)
{
	if(ac[i].innerHTML == "Örökbefogadott")
	{
		ac[i].style.color="#960000";
		ac[i].style.backgroundColor="#FF9664";
		ac[i].style.boxShadow="#FF9664";
	}
	else if(ac[i].innerHTML == "Elérhető")
	{
		ac[i].style.backgroundColor="#af0";
		ac[i].style.color="#080";
		ac[i].style.boxShadow="#af0";
	}
}


</script>
</body>
</html>