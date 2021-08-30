<?php
require_once "../includes/db_config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
	<title>Admin</title>
	<style>
	.wrapper{
		width: 500px;
		position: absolute;
		left: 50%;
		transform: translateX(-50%);
		top: 150px;
		padding: 15px;
		background-color: #0049cc;
		border: 1px solid #ced4da;
		border-radius: 20px;
		box-shadow: 0 0 10px #0049cc;
	}
	
	html{
		height: 100%;
	}
	
	body {
		margin: 0px;
		padding: 0px;
		background-image: linear-gradient(#043, #0c3);
		height: 100%;
		width: 100%;
		background-repeat: no-repeat;
		background-attachment: fixed;
		color: #fff;
		font-family: 'Ubuntu', sans-serif;
	}


	.animal-input{
		width: 100%;
		height: 80px;
		font-size: 18px;
		border-radius: 10px;
		border: 1px solid #ced4da;
		border-radius: .25rem;		
		background-color: #007bff;
		color: #fff;
		resize: none;
	}
	
	.div1{
		background-color:#0049cc; 
		padding:15px;
		width: 500px;
		position: absolute;
		left: 50%;
		transform: translateX(-50%);
		top: 50px;
		font-size: 20px;
		background-color: #0049cc;
		border: 1px solid #ced4da;
		border-radius: .25rem;		
		box-shadow: 0 0 10px #0049cc;
		text-align: center;
	}
	
	
	.div2, .div3, .div4, .div5, .div6{
		background-color:#0049cc; 
		padding:15px;
		width: 500px;
		position: relative;
		font-size: 20px;
		top: 1100px;
		background-color: #0049cc;
		border: 1px solid #ced4da;
		border-radius: .25rem;		
		box-shadow: 0 0 10px #0049cc;
		text-align: center;
	}

	.div3{
		top: 1000px;
		color: #99ffff;
	}

	.div4{
		top: 950px;
	}
	.div5{
		top: 1090px;
	}
	.div6{
		top: 1050px;
	}
	@media screen and (max-width: 570px) {
		.div1, .wrapper,  .div3, .div5,.div4, .div6, .div2
		{
			width: 90vw;
		}
	}
	@media screen and (max-width: 500px){
		.own-pets{
			width: 90vw;
		}
		.img5{
			width: 100%;
		}
	}

	@media screen and (max-width: 260px){
		.anchor{
			font-size: 6vw;
		}
	}
	</style>
</head>
<body>
	<div id="arrow"></div>
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
	<div class="container-fluid div1">Új állat hozzáadása</div>
	
	<div class="wrapper">
		<form method="post" action="adminLoggedIn.php">
		<?php
		if(isset($_POST['addAnimal']))
		{
			if(($_POST['animalSelect']) == '' || ($_POST['statusSelect'])=='' || empty($_POST['age']) || empty($_POST['image']) || empty($_POST['desc']))
			{
				echo "<b class='p3'>Minden mezőt töltsön ki!</b><br>";
			}
			else if(($_POST['animalSelect']) != '' || ($_POST['statusSelect']) !=''  || !empty($_POST['age']) || !empty($_POST['image']) || !empty($_POST['desc']))
			{
				$email = "admin@gmail.com";
				$cId = $_POST['animalSelect'];
				$sId = $_POST['statusSelect'];
				$age = $_POST['age'];
				$img = $_POST['image'];
				$desc = $_POST['desc'];
				$active= 1;
				
				$sql = "INSERT INTO pets (email,age,image,description,categoryId,active,statusId) VALUES(:email,:age, :img, :desc, :cId, :active, :sId)";
				$query = $connect->prepare($sql);
				$query->bindValue(":email",$email);
				$query->bindValue(":age",$age);
				$query->bindValue(":img",$img);
				$query->bindValue(":desc",$desc);
				$query->bindValue(":cId",$cId);
				$query->bindValue(":active",$active);
				$query->bindValue(":sId",$sId);
				$query->execute();
				
				echo "<br><b class='par1'>Sikeresen hozzáadva!</b><br>";
			}
		}
		?>
			<label for="lbl-anml1"><b>Állat fajtája</b></label><br>
			<select class="form-control" name="animalSelect" style="background-color:#007bff; color:#fff;" id="lbl-anml1">
				<option class="animal-input" value=''>Válasszon egy állatot</option>
				<?php
					for($i=0; $i<count($Id); $i++)
					{
						echo "<option value='".$Id[$i]['categoryId']."'>".$type[$i]['type']."</option>";
					}
				?>
			</select>
			<br>
			<label for="lbl-anml2"><b>Állapota</b></label>
			<select class="form-control" id="lbl-anml2" name="statusSelect" style="background-color:#007bff; color:#fff;">
				<option value=''>Válasszon egy állapotot</option>
				<?php
					for($i=0; $i<count($statusId); $i++)
					{
						echo "<option value='".$statusId[$i]['statusId']."'>".$status[$i]['status']."</option>";
					}
				?>
			</select><br>
			<label for="lbl-anml3"><b>Életkor</b></label>
			<input type="text" name="age" id="lbl-anml3" class="form-control" style="background-color:#007bff; color:#fff;"><br><br>
			<label for="lbl-anml4"><b>Kép megadása</b></label>
			<input type="text" name="image" id="lbl-anml4" class="form-control" style="background-color:#007bff; color:#fff;"><br><br>
			<label for="lbl-anml5"><b>Leírás</b></label>
			<textarea name="desc" class="animal-input" id="lbl-anml5"></textarea><br><br>
			<br>
				<input class="btn btn-primary btn-lg btn-block" type="submit" value="Hozzáadás" name="addAnimal">
				<input class="btn btn-primary btn-lg btn-block" type="reset" value="Alaphelyzet" name="rs">
		</form>
	</div>
	
	<div class="container-fluid div3"><a class='anchor' href='delCat.php'>Kategória Törlése</a></div>
	<div class="container-fluid div5"><a class='anchor' href='updCat.php'>Kategória Módosítása</a></div>
	<div class="container-fluid div4"><a class='anchor' href='addCat.php'>Kategória Hozzáadása</a></div>
	<div class="container-fluid div6"><a class='anchor' href='banUser.php'>Felhasználó Bannolása/Unbannolása</a></div>



	<div class="container-fluid div2">Az összes állat</div>
	
	<div class="own-pets">
		<?php
		$sql = "SELECT * FROM pets INNER JOIN category ON pets.categoryId = category.categoryId INNER JOIN status s ON pets.statusId = s.statusId";
		$query = $connect->prepare($sql);
		$query->execute();
		$i = 0;
		$counter = 0;
		while($row = $query->fetch(PDO::FETCH_ASSOC))
		{
			$i++;
			$counter++;
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
				<div class='pet-advertisement-caption6'>
					Állat fajtája: $type<br>
					Állapota: $status<br>
					Életkor: $petAge<br>
					Aktív-e: <span class='activeOrNot'>$isActive</span>
				</div>
					<a href='adminDescription.php?id=$id'><img class='img5' src='../images/animals/$image' alt='hírdetés'></a><br><br><br>
					<div class='center-buttons'>
					
						<form method='post' action='adminUpdate.php'>
							<input class='update-delete' type='hidden' value='$id' name='updatePet'>
							<input type='hidden' name='petId' value='$id'>
							<input class='update-delete' type='submit' value='Frissítés' name='update'>
						</form>
						<form method='post' action='adminDelete.php'>
							<input class='update-delete' type='hidden' value='$id' name='deletePet'>
							<input class='update-delete' type='submit' value='Törlés' name='delete'>
						</form>
					</div>
				</div>
				
				";
				if($i==2)
				{
					echo "<h6></h6>";
					$i=0;
				}
		}
		echo "<div class='counter2'>Állatok száma: $counter</div>";
		?>
	</div>
<script src="../JavaScript/changeColor.js"></script>

<a href="#arrow">
<div><img class="arrow" src="../images/upArrow.png"></div>
	<div class="bottom-arrow">
		<div class="arrow-top"></div>
		<div class="arrow-shape"></div>
	</div>
</a>
<script>
	for(let i = 0; i<document.querySelectorAll(".pet-aod").length; i++)
	{
		if(ac[i].innerHTML == 'Örökbefogadott')
		{
			document.querySelectorAll(".pet-aod")[i].style.backgroundColor="#54626F";
			document.querySelectorAll(".img5")[i].style.filter="grayscale(100%)";
		}
	}

</script>

</body>
</html>
