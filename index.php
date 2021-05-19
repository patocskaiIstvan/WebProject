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
    <link rel="stylesheet" href="styles.css">
    <title>Állat örökbefogadás</title>
</head>
<body>
<div id="arrow"></div>
	<div class="main-nav-div">
		<div class="nav-div-1">
			<ul class="nav-ul">
				<li class="nav-li"><a class="nav-a" href="index.php">KEZDŐLAP</a></li>
				<li class="nav-li"><a class="nav-a" href="pets.php">ÁLLATOK</a></li>
				<li class="nav-li"><a class="nav-a" href="index.php">HARMADIK</a></li>
			</ul>
		</div>
		<div class="nav-div-2">
			<ul class="nav-ul-2">
				<li class="nav-li"><a class="nav-login-register" href="login.php">BEJELENTKEZÉS</a></li>
				<li class="nav-li"><a class="nav-logout" href="login.php">KIJELENTKEZÉS</a></li>
			</ul>
		</div>
	</div>
		
	<div class="responsive-nav-main-div">
		<label for="responsive-nav" class="responsive-nav-label"><img  class="hamburger" src="images/hamburger1.png" alt="Responsive-NAV"></label>
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
	<script src="javascript1.js"></script><br><br><br>
	<div class="pet-caption-div"><p class="pet-caption">Legújabb örökbefogadható állataink:</p></div>
<div class="advertisement-main-div">
<?php
require_once "includes/db_config.php";
$sqlCommand="SELECT * FROM pets INNER JOIN category ON pets.categoryId = category.categoryId";
$sqlQuery=$connect->prepare($sqlCommand);
$sqlQuery->execute();
$i=0;
while($row = $sqlQuery->fetch(PDO::FETCH_ASSOC)) 
{
	$i++;
	$id=$row["id"];
    $type=$row["type"];
    $status=$row["status"];
    $petAge=$row["age"];
	$image=$row["image"];
	$description=$row["description"];
    echo "
		<div class='pet'>
		<div class='pet-advertisement-caption'>
			Állat fajtája: $type<br>
			Állapota: $status<br>
			Életkor: $petAge<br><br>
		</div>
			<a href='petDescription.php?id=$id'><img class='img1' src='images/animals/$image' alt='hírdetés'></a>
			<img class='star-img' alt='star' src='images/star2.png'>
		</div>";
		if($i==2)
		{
			echo "<h6></h6>";
			$i=0;
		}
}
?>
</div>	
<script src="javascript2.js"></script>



<a href="#arrow">
	<div class="bottom-arrow">
		<div class="arrow-top"></div>
		<div class="arrow-shape"></div>
	</div>
</a>
</body>
</html>

