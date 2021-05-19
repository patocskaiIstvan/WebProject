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
    <title>Állat leírása</title>
</head>
<body>
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
	<br><br><br>
<div class="pet-description-main-div">
<?php
	require("includes/db_config.php");
		$id=$_GET["id"];
		$sqlCommand2="SELECT * FROM pets INNER JOIN category ON pets.categoryId = category.categoryId WHERE id = :ID ";
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

    echo "
		<div class='pet-description'>
		<div class='pet-description-caption'>
			<img class='img2' src='images/animals/$image' alt='hírdetés'>
			<div class='caption'>
				Állat fajtája: $type<br><br>
				Állapota: $status<br><br>
				Életkor: $petAge<br><br>
				<input class='cbox1' type='checkbox' name='chbox1'>
				<div class='cbox1-div'>";
				/*if($isActive == 0)
				{
					echo "
					<script>
						let cbox1 = document.getElementsByClassName("cbox1");
						let cbox1Div = document.getElementsByClassName("cbox1-div");
						let slider1 = document.getElementsByClassName("slider1");
						console.log(cbox1);
					</script>
					";
				}*/
					echo " <div class='slider1'><div class='slider-dot'></div></div></div><a class='cbox-status'>Inaktív</a>
			</div>
		</div>
		</div>";
	}
?>

</div>	
<script src="petDesc.js"></script>

<script src="javascript2.js"></script><br><br><br>

</body>
</html>