<?php
require_once "../includes/db_config.php";
session_start();
if(isset($_POST['update']))
{
	/*
	$updateId = $_POST['updatePet'];
	header("location: updatePet.php?id=$updateId");
	*/
	
	$id=$_POST['updatePet'];
}
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
	
	<div class="profile-div">
		<img><br>
		<div>
		<?php 
		$email= $_SESSION['email'];
		$sql = "SELECT * FROM signedup WHERE email = :email";
		$query = $connect->prepare($sql);
		$query->bindValue(":email",$email);
		$query->execute();
		while($row = $query->fetch(PDO::FETCH_ASSOC)) 
		{
			$id = $row['id'];
			$fname = $row["fname"];
			$lname = $row["lname"];
			$date = $row["signedUpDate"];
			$isActivated = $row["activatedUser"];
			if($isActivated == 0)
			{
				$isActivated = "nincs aktiválva";
			}
			else if($isActivated == 1)
			{
				$isActivated = "aktiválva";
			}
			echo "
			<div class='user-profile'>
				<div><img src=''></div>
				<span class='sp1'>Felhasználói adatok</span><br><br>
				E-mail cím: $email<br>
				Teljes név: $lname $fname<br>
				Regisztrálás időpontja: $date<br>
				Fiók állapota: $isActivated<br>	<br>
				<a class='new-values' href='updateProfile.php'>Felhasználói adatok megváltoztatása</a>		
			</div>
			";
		}
		?>
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
	
	<div class="add-animal">
		<p class='new-animal'>Állat Hozzáadása:</p>
		<?php
			if(isset($_POST['sb']))
			{
				if(($_POST['animalSelect']) == '' || ($_POST['statusSelect'])=='' || empty($_POST['age']) || empty($_POST['image']) || empty($_POST['desc']))
				{
					echo "<b class='p3'>Minden mezőt töltsön ki!</b><br>";
				}
				else if(($_POST['animalSelect']) != '' || ($_POST['statusSelect']) !=''  || !empty($_POST['age']) || !empty($_POST['image']) || !empty($_POST['desc']))
				{
					$email = $_SESSION['email'];
					$cId = $_POST['animalSelect'];
					$sId = $_POST['statusSelect'];
					$age = $_POST['age'];
					$img = $_POST['image'];
					$desc = $_POST['desc'];
					
					
					$sql = "INSERT INTO pets (email,age,image,description,categoryId,statusId) VALUES(:email, :age, :img, :desc, :cId, :sId)";
					$query = $connect->prepare($sql);
					$query->bindValue(":email",$email);
					$query->bindValue(":age",$age);
					$query->bindValue(":img",$img);
					$query->bindValue(":desc",$desc);
					$query->bindValue(":cId",$cId);
					$query->bindValue(":sId",$sId);
					$query->execute();
					
					echo "<br><b class='par1'>Sikeresen hozzáadva!</b><br>";
				}
			}
		?>
		<form method="post" action="profile.php">
			<label class="lbl-anml">Állat fajtája</label>
			<input name="enterAnimal" type="text" class="enter-animal">
			<select class="animal-input" name="animalSelect">
				<option class="animal-input" name='animalOpt' value=''>Válasszon egy állatot</option>
				<?php
					for($i=0; $i<count($Id); $i++)
					{
						echo "<option  value='".$Id[$i]['categoryId']."'>".$type[$i]['type']."</option>";
					}
				?>
			</select>
			<br><br>
			<input type="checkbox" class="not-on-list" name="addAnimal">
			<label class="lbl-anml">Állapota</label>
			<select class="animal-input" name="statusSelect">
				<option name='statusOpt' value=''>Válasszon egy állapotot</option>
				<?php
					for($i=0; $i<count($statusId); $i++)
					{
						echo "<option  value='".$statusId[$i]['statusId']."'>".$status[$i]['status']."</option>";
					}
				?>
			</select><br><br>
			<label class="lbl-anml">Életkor</label>
			<input type="text" name="age" class="animal-input"><br><br>
			<label class="lbl-anml">Kép megadása</label>
			<input type="text" name="image" class="animal-input"><br><br>
			<label class="lbl-anml">Leírás</label>
			<textarea name="desc" class="animal-input2"></textarea><br><br>
			<br>
			<div class="center-buttons">
				<input class="sr-buttons" type="submit" value="Hozzáadás" name="sb">
				<input class="sr-buttons" type="reset" value="Alaphelyzet" name="rs">
			</div>
		</form>
	</div>
	

	
	<div class="own-pets-paragraph">Saját Állatok</div>
	
	<div class="own-pets2">
		<?php
		$sql = "SELECT * FROM pets INNER JOIN category ON pets.categoryId = category.categoryId INNER JOIN status s ON pets.statusId = s.statusId WHERE email = :email";
		$query = $connect->prepare($sql);
		$query->bindValue(":email",$_SESSION["email"]);
		$query->execute();
		$i = 0;
		$counter = 0;
		if($query->rowCount()==0)
		{
			echo "
			<script>
			document.querySelector('.own-pets-paragraph').style.display='none';

			</script>
			";
		}
		if($query->rowCount()==1)
		{
			echo "
			<script>
			document.querySelector('.own-pets2').classList.add('op');
			document.querySelector('.own-pets2').classList.remove('own-pets2');
	</script>
			";
		}
		if($query->rowCount()>1)
		{
			echo "
			<script>
			document.querySelector('.own-pets2').classList.remove('op');
			document.querySelector('.own-pets2').classList.add('own-pets2');
			</script>
			";
		}

		while($row = $query->fetch(PDO::FETCH_ASSOC))
		{
			$counter++;
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
				echo "
					<div class='pet-aod'>
					<form method='post'>";
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
						echo "<input type='image' class='star-img' alt='star' src='../images/star.png'>";
					}
					else
					{
						echo "<input type='image' class='star-img' alt='star' src='../images/star2.png'>";
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
					<a href='petDescription.php?id=$id'><img class='img1' src='../images/animals/$image' alt='hírdetés'></a><br><br><br>
					<div class='center-buttons'>
					
						<form method='post' action='updatePet.php'>
							<input class='update-delete' type='hidden' value='$id' name='updatePet'>
							<input type='hidden' name='petId' value='$id'>
							<input class='update-delete' type='submit' value='Frissítés' name='update'>
						</form>
						<form method='post' action='deletePet.php'>
							<input class='update-delete' type='hidden' value='$id' name='deletePet'>
							<input class='update-delete' type='submit' value='Törlés' name='delete'>
						</form>
					</div>
				</div>";
					if($i==2)
					{
						echo "<h6></h6>";
						$i=0;
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
			window.location='profile.php';
			</script>
			";
		}
	

		?>
	</div>
	
<script src="../Javascript/listPets.js"></script>
<script>

for(let i = 0; i<document.querySelectorAll(".activeOrNot2").length; i++)
{
	if(document.querySelectorAll(".activeOrNot2")[i].innerHTML == "Örökbefogadott")
	{
		document.querySelectorAll(".activeOrNot2")[i].style.color="#f05";
		document.querySelectorAll(".pet-aod")[i].style.backgroundColor="#54626F";
		document.querySelectorAll(".star-img")[i].style.display="none";
		document.querySelectorAll(".pet-advertisement-caption")[i].style.marginTop="28px";
		document.querySelectorAll(".img1")[i].style.filter="grayscale(100%)";
	}
	else if(document.querySelectorAll(".activeOrNot2")[i].innerHTML == "Elérhető")
	{
		document.querySelectorAll(".activeOrNot2")[i].style.color="#0f0";
	}
}

</script>
<a href="#arrow">
<div><img class="arrow" src="../images/upArrow.png"></div>
	<div class="bottom-arrow">
		<div class="arrow-top"></div>
		<div class="arrow-shape"></div>
	</div>
</a>
</body>
</html>

