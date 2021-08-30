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
				<li class="nav-li"><a class="profile" href="login.php">PROFIL</a></li>
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
						let register = document.getElementsByClassName('nav-login-register');
						
						register[0].innerHTML= 'BEJELENTKEZVE';
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
				<li class="responsive-nav-li"><a class="responsive-nav-a" href="../index.php">HARMADIK</a></li>
				<li class="responsive-nav-li"><a class="responsive-nav-login-register" href="login.php">BEJELENTKEZÉS</a></li>
			</ul>
		</div>
	</div>
	
<?php
require_once "../includes/db_config.php";
$Id = array(array());
$type = array(array());
$sql = "SELECT * FROM category";
$result = $connect->prepare($sql);
$result->execute();
$i = 0;
while($row = $result->fetch(PDO::FETCH_ASSOC))
{	
	$Id[$i]['categoryId'] = $row['categoryId'];
	$type[$i]['type'] = $row['type'];
	$i++;
}
	
$statusId = array(array());
$status = array(array());
$sql2 = "SELECT * FROM status";
$result2 = $connect->prepare($sql2);
$result2->execute();
$i = 0;
while($row2 = $result2->fetch(PDO::FETCH_ASSOC))
{	
	$statusId[$i]['statusId'] = $row2['statusId'];
	$status[$i]['status'] = $row2['status'];
	$i++;
}
?>
	
	
<div class="update-pet">
		<form method="post" action="updatePet.php">
			<label class="lbl-anml">Állat fajtája</label>
			<select class="animal-input" name="animalSelect2">
				<option class="animal-input">Válasszon egy állatot</option>
				<?php
					for($i=0; $i<count($Id); $i++)
					{
						echo "<option value='".$Id[$i]['categoryId']."'>".$type[$i]['type']."</option>";
					}
				?>
			</select>
			<br><br>
			<input type="checkbox" class="not-on-list" name="addAnimal">
			<label class="lbl-anml">Állapota</label>
			<select class="animal-input" name="statusSelect2">
				<option>Válasszon egy állapotot</option>
				<?php
					for($i=0; $i<count($statusId); $i++)
					{
						echo "<option value='".$statusId[$i]['statusId']."'>".$status[$i]['status']."</option>";
					}
				?>
			</select><br><br>
			<label class="lbl-anml">Életkor</label>
			<input type="text" name="age2" class="animal-input"><br><br>
			<label class="lbl-anml">Kép megadása</label>
			<input type="text" name="image2" class="animal-input"><br><br>
			<label class="lbl-anml">Leírás</label>
			<textarea name="desc2" class="animal-input2"></textarea><br><br>
			<?php
			$petId = $_POST['updatePet'];
			if(isset($_POST['updateThisPet']))
			{
				$email = $_SESSION['email'];
				$cId = $_POST['animalSelect2'];
				$sId = $_POST['statusSelect2'];
				$age = $_POST['age2'];
				$img = $_POST['image2'];
				$desc = $_POST['desc2'];
				
				
				$sql = "UPDATE pets SET age=:age, image=:img, description=:desc, categoryId=:cId, active=1, statusId=:sId WHERE id=:id";
				$query = $connect->prepare($sql);
				$query->bindValue(":id",$petId);
				$query->bindValue(":age",$age);
				$query->bindValue(":img",$img);
				$query->bindValue(":desc",$desc);
				$query->bindValue(":cId",$cId);
				$query->bindValue(":sId",$sId);
				$query->execute();
				
				echo "<div class='added'><b>Sikeresen Frissítve!</b></div><br><br>
				<script>
				function goTo()
				{
					window.location='profile.php';
				}
				setTimeout(goTo,2000);
				</script>
				
				";
				

			}
			?>

			<br>
			<div class="center-buttons">
				<input class="sr-buttons" type="submit" value="Frissítés" name="updateThisPet">
				<?php
				echo " <input type='hidden' value='$petId' name='updatePet'>";
				?>
				<input class="sr-buttons" type="reset" value="Alaphelyzet" name="rs">
			</div>
		</form>

</div>
	
	
<script src="../Javascript/javascript2.js"></script>
	
</body>
</html>

