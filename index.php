<?php
require_once "includes/db_config.php";
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
    <link rel="stylesheet" href="css/styles.css">
    <title>Állat örökbefogadás</title>
</head>
<body>
<div id="arrow"></div>
	<div class="main-nav-div">
		<div class="nav-div-1">
			<ul class="nav-ul">
				<li class="nav-li"><a class="nav-a" href="index.php">KEZDŐLAP</a></li>
				<li class="nav-li"><a class="nav-a" href="php/pets.php">ÁLLATOK</a></li>
				<li class="nav-li"><a class="nav-a" href="php/favorites.php">KEDVENCEK</a></li>
				<li class="nav-li"><a class="nav-a" href="php/msg.php">ÜZENETEK</a></li>
			</ul>
		</div>
		<div class="nav-div-2">
			<ul class="nav-ul-2">
				<li class="nav-li"><a class="profile" href="php/profile.php">PROFIL</a></li>
				<?php
				if(isset($_SESSION['email']))
				{
					echo "<script>
						let profile = document.getElementsByClassName('profile');
						profile[0].href = 'php/profile.php';
					</script>
					";
				}
				else
				{
					echo "
					<script>
						let profile = document.getElementsByClassName('profile');
						profile[0].href= 'php/login.php';
					</script>
					";
				}
				?>
				<li class="nav-li"><a class="nav-login-register" href="php/login.php">BEJELENTKEZÉS</a></li>
				<?php 
				if(isset($_SESSION['email']))
				{
					echo "<script>
						document.getElementsByClassName('nav-login-register')[0].innerHTML = 'BEJELENTKEZVE';
					</script>";
				}
				?>
				<li class="nav-li"><a class="nav-logout" href="php/login.php">KIJELENTKEZÉS</a></li>
			</ul>
		</div>
	</div>
		
	<div class="responsive-nav-main-div">
		<label for="responsive-nav" class="responsive-nav-label"><img  class="hamburger" src="images/hamburger1.png" alt="Responsive-NAV"></label>
		<input type="checkbox" id="responsive-nav" class="responsive-nav">
		<div class="responsive-nav-div">
			<ul class="responsive-nav-ul">
				<li class="responsive-nav-li"><a class="responsive-nav-a" href="index.php">KEZDŐLAP</a></li>
				<li class="responsive-nav-li"><a class="responsive-nav-a" href="php/pets.php">ÁLLATOK</a></li>
				<li class="responsive-nav-li"><a class="responsive-nav-a" href="php/favorites.php">KEDVENCEK</a></li>
				<li class="responsive-nav-li"><a class="responsive-nav-a" href="php/msg.php">ÜZENETEK</a></li>
				<li class="responsive-nav-li"><a class="responsive-nav-a prf" href="php/profile.php">PROFIL</a></li>
				<?php
				if(isset($_SESSION['email']))
				{
					echo "<script>
						let prf = document.getElementsByClassName('prf');
						prf[0].href = 'php/profile.php';
					</script>
					";
				}
				else
				{
					echo "
					<script>
						let prf = document.getElementsByClassName('prf');
						prf[0].href= 'php/login.php';
					</script>
					";
				}
				?>
				<li class="responsive-nav-li"><a class="responsive-nav-login-register" href="php/login.php">BEJELENTKEZÉS</a></li>
			</ul>
		</div>
	</div>
	
	<div class="main-slideShow-div">
		<div class="slideshow-container">
			<div class="my-slides">
					<img class="pic" src="images/animals/owl.jpg">
			</div>

			<div class="my-slides">
					<img class="pic" src="images/animals/dog2.jpg">
			</div>

			<div class="my-slides">
					<img class="pic" src="images/animals/dog3.jpg">
			</div>
	
			<img class="prev" src="images/leftArrow2.png" alt="leftArrow">
			<img class="next" src="images/rightArrow2.png" alt="rightArrow">
		
			<div class="slider-div" style="text-align:center">
			
			</div>
		</div>
	</div>
	<script src="JavaScript/javascript1.js"></script><br><br><br>
	<div class="pet-caption-div"><p class="pet-caption">Elérhető állataink:</p></div>
	
<div class="advertisement-main-div">
<?php
$sqlCommand="SELECT * FROM pets INNER JOIN category ON pets.categoryId = category.categoryId INNER JOIN status ON pets.statusId = status.statusId WHERE active = 1";
$sqlQuery=$connect->prepare($sqlCommand);
$sqlQuery->execute();
$i=0;
$counter = 0;
while($row = $sqlQuery->fetch(PDO::FETCH_ASSOC)) 
{
	$i++;
	$id=$row["id"];
    $type=$row["type"];
    $status=$row["status"];
    $petAge=$row["age"];
	$image=$row["image"];
	$description=$row["description"];
	$active = $row["active"];
	if($active == 0)
	{
		$isActive = "Örökbefogadott";
	}
	else if($active == 1)
	{
		$isActive = "Elérhető";
	}
	$counter++;
	if($counter < 7)
	{
		echo "
			<div class='pet'>
			<input type='hidden' value='$counter' class='favoriteCounter'>";
		if(isset($_SESSION["email"]))
		{
			echo"
			<form method='post' class='submitForm'>";
			$userId = $_SESSION['email'];
			$sqlGetID = "SELECT id FROM signedup WHERE email = :email";
			$result = $connect->prepare($sqlGetID);
			$result->bindValue(":email",$userId);
			$result->execute();
			$row = $result->fetch();
			$id2 = $row["id"];
			
			$sql3 = "SELECT * FROM users_pets WHERE userID = ".$id2." AND petID = ".$id;
			$q2 = $connect->prepare($sql3);
			$q2->execute();
			if($q2->rowCount()==1)
			{
				echo "<input type='image' class='star-img' alt='star' src='images/star.png'>";
			}
			else
			{
				echo "<input type='image' class='star-img' alt='star' src='images/star2.png'>";
			}
		}
			echo"
			<input value='$id' type='hidden' name='favorite'>
			</form>
			<div class='pet-advertisement-caption'>
				Állat fajtája: $type<br>
				Állapota: $status<br>
				Életkor: $petAge<br>
				Aktív-e: <span class='activeOrNot2'>$isActive</span>
			</div>
				<a href='php/petDescription.php?id=$id'><img class='img1' src='images/animals/$image' alt='hírdetés'></a>
			</div>";
			if($i==2)
			{
				echo "<h6></h6>";
				$i=0;
			}
		
	}
}


if(isset($_POST['favorite']))
{
	$id = $_POST['favorite'];
	$userId = $_SESSION['email'];

	$sqlGetID = "SELECT id FROM signedup WHERE email = :email";
	$result = $connect->prepare($sqlGetID);
	$result->bindValue(":email",$userId);
	$result->execute();
	$row = $result->fetch();
	$id2 = $row["id"];



	$sql3 = "SELECT * FROM users_pets WHERE userID = ".$id2." AND petID = ".$id;
	$q2 = $connect->prepare($sql3);
	$q2->execute();
	if($q2->rowCount()==0)
	{
		$id2 = $row["id"];
		$id = $_POST['favorite'];
		$sql = "INSERT INTO users_pets(userID,petID) VALUES(:uId, :pID)";
		$query=$connect->prepare($sql);
		$query->bindValue(":uId",$id2);
		$query->bindValue(":pID",$id);
		$query->execute();
		echo "
		<script>
		let star = document.querySelectorAll('.star-img');
		star[0].src='images'/star.png';
		</script>		
		";
	}
	else
	{
		$row = $q2->fetch();
		$petId = $row["petID"];
		$userId = $row["userID"];
		$sql = "DELETE FROM users_pets WHERE petID = :pID AND userID = :uID";
		$q3 = $connect->prepare($sql);
		$q3->bindValue(":pID",$petId);
		$q3->bindValue(":uID",$userId);
		$q3->execute();
		echo "
		<script>
		let star = document.querySelectorAll('.star-img');
		star[0].src='images'/star2.png';
		</script>		
		";
	}
	echo "
	<script>
	window.location='index.php';
	</script>
	";
}

?>
</div>	



<a href="#arrow">
<div><img class="arrow" src="images/upArrow.png"></div>
	<div class="bottom-arrow">
		<div class="arrow-top"></div>
		<div class="arrow-shape"></div>
	</div>
</a>



<div class="pet-caption-div2"><p class="pet-caption2">Örökbefogadott állataink:</p></div>
<div class="advertisement-main-div2">
<?php
$sqlCommand="SELECT * FROM pets INNER JOIN category ON pets.categoryId = category.categoryId INNER JOIN status ON pets.statusId = status.statusId WHERE active = 0";
$sqlQuery=$connect->prepare($sqlCommand);
$sqlQuery->execute();
$i=0;
$counter=0;
while($row = $sqlQuery->fetch(PDO::FETCH_ASSOC)) 
{
	$i++;
	$id=$row["id"];
    $type=$row["type"];
    $status=$row["status"];
    $petAge=$row["age"];
	$image=$row["image"];
	$description=$row["description"];
	$active = $row["active"];
	if($active == 0)
	{
		$isActive = "Örökbefogadott";
	}
	else if($active == 1)
	{
		$isActive = "Elérhető";
	}
	$counter++;
	if($counter < 7)
	{
		echo "
			<div class='pet2'>
			<div class='pet-advertisement-caption'>
				Állat fajtája: $type<br>
				Állapota: $status<br>
				Életkor: $petAge<br>
				Aktív-e: <span class='activeOrNot2'>$isActive</span>
			</div>
				<a href='php/petDescription.php?id=$id'><img class='img3' src='images/animals/$image' alt='hírdetés'></a>
			</div>";
			if($i==2)
			{
				echo "<h6></h6>";
				$i=0;
			}
	}
}
?>

<script>
let ac = document.querySelectorAll(".activeOrNot2");
console.log(ac[0]);

for(let i = 0; i<ac.length; i++)
{
	if(ac[i].innerHTML == "Örökbefogadott")
	{
		ac[i].style.color="#f05";
	}
	else if(ac[i].innerHTML == "Elérhető")
	{
		ac[i].style.color="#cf0";
	}
}
</script>
<?php
if(!isset($_SESSION["email"]))
{
	echo"
	<script>
	for(let i = 0; i<document.querySelectorAll('.pet').length; i++)
	{
		document.querySelectorAll('.pet')[i].style.height='max-content';
	}
	for(let i = 0; i<document.querySelectorAll('.pet2').length; i++)
	{
		document.querySelectorAll('.pet2')[i].style.height='max-content';
	}
	</script>
	";
}
if(isset($_SESSION["email"]))
{
	echo"
	<script>
	for(let i = 0; i<document.querySelectorAll('.pet').length; i++)
	{
		document.querySelectorAll('.pet')[i].style.height='max-content';
	}
	for(let i = 0; i<document.querySelectorAll('.pet2').length; i++)
	{
		document.querySelectorAll('.pet2')[i].style.height='max-content';
	}
	</script>
	";
}
?>
</body>
</html>

