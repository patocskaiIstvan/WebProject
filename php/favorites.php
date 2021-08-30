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
	<div class="advertisement-main-div3 js">
<?php
$sqlCommand="SELECT * FROM pets INNER JOIN category ON pets.categoryId = category.categoryId INNER JOIN status ON pets.statusId = status.statusId WHERE active = 1";
$sqlQuery=$connect->prepare($sqlCommand);
$sqlQuery->execute();
$i=0;
$counter = 0;
while($row = $sqlQuery->fetch(PDO::FETCH_ASSOC)) 
{
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
	echo "
			<input type='hidden' value='$counter' class='favoriteCounter'>
			<form method='post'>";
	$userId = $_SESSION['email'];
	$sqlGetID = "SELECT id FROM signedup WHERE email = :email";
	$result = $connect->prepare($sqlGetID);
	$result->bindValue(":email", $userId);
	$result->execute();
	$row = $result->fetch();
	$id2 = $row["id"];	
	$c = 0;


	$sql3 = "SELECT * FROM users_pets WHERE userID = " . $id2 . " AND petID = " . $id;
	$q2 = $connect->prepare($sql3);
	$q2->execute();
	if ($q2->rowCount() == 1) 
	{
		$i++;
		echo "
	
				<div class='pet'>
				<input type='image' class='star-img' alt='star' src='../images/star.png'>
				<input value='$id' type='hidden' name='favorite'>
				</form>
				<div class='pet-advertisement-caption'>
					Állat fajtája: $type<br>
					Állapota: $status<br>
					Életkor: $petAge<br>
					Aktív-e: <span class='activeOrNot2'>$isActive</span>
				</div>
					<a href='../php/petDescription.php?id=$id'><img class='img1' src='../images/animals/$image' alt='hírdetés'></a>
				</div>
				<script>
				for(let i = 0; i<document.querySelectorAll('.activeOrNot2').length; i++)
				{
					document.querySelectorAll('.activeOrNot2')[i].style.color='#cf0';
				}
				</script>
				
				
				";
				if($i == 1)
				{
					echo "<script>
					document.querySelector('.js').classList.add('advertisement-main-div3');
					document.querySelector('.js').classList.remove('advertisement-main-div6');
					</script>";
				}
				else
				{
					echo "<script>
					document.querySelector('.js').classList.remove('advertisement-main-div3');
					document.querySelector('.js').classList.add('advertisement-main-div6');
					</script>";
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
	window.location='favorites.php';
	</script>
	";
}
if(!isset($_SESSION["email"])){
	echo "<script>
	window.location='login.php';
	</script>";
}
?>
</div>

<a href="#arrow">
<div><img class="arrow" src="../images/upArrow.png"></div>
	<div class="bottom-arrow">
		<div class="arrow-top"></div>
		<div class="arrow-shape"></div>
	</div>
</a>

</body>
</html>
