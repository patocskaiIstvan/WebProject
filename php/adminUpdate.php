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
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css2?family=Poiret+One&family=Ubuntu&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/styles.css">
	<style>
		.wrapper{
		width: 500px;
		position: absolute;
		left: 50%;
		transform: translateX(-50%);
		top: 100px;
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

	</style>
    <title>Állat örökbefogadás</title>
</head>
<body>
	
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
	
	
<div class="wrapper">
		<form method="post" action="adminUpdate.php">
			<label for="lbl-anml1">Állat fajtája</label>
			<select class="form-control" name="animalSelect2" id="lbl-anml1" style="background-color:#007bff; color:#fff;">
				<option class="animal-input">Válasszon egy állatot</option>
				<?php
					for($i=0; $i<count($Id); $i++)
					{
						echo "<option value='".$Id[$i]['categoryId']."'>".$type[$i]['type']."</option>";
					}
				?>
			</select>
			<br>
			<label for="lbl-anml2">Állapota</label>
			<select class="form-control" name="statusSelect2" id="lbl-anml2" style="background-color:#007bff; color:#fff;">
				<option>Válasszon egy állapotot</option>
				<?php
					for($i=0; $i<count($statusId); $i++)
					{
						echo "<option value='".$statusId[$i]['statusId']."'>".$status[$i]['status']."</option>";
					}
				?>
			</select><br>
			<label for="lbl-anml3">Életkor</label>
			<input type="text" name="age2" id="lbl-anml3" class="form-control" style="background-color:#007bff; color:#fff;"><br>
			<label for="lbl-anml4">Kép megadása</label>
			<input type="text" name="image2" id="lbl-anml4" class="form-control" style="background-color:#007bff; color:#fff;"><br>
			<label for="lbl-anml5">Leírás</label>
			<textarea name="desc2" class="form-control" id="lbl-anml5" style="resize:none; height:100px; background-color:#007bff; color:#fff;"></textarea><br>
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
				
				echo "<b>Sikeresen Frissítve!</b><br><br>
				<script>
				function goTo()
				{
					window.location='adminLoggedIn.php';
				}
				setTimeout(goTo,500);
				</script>
				
				";
				

			}
			?>

			<br>
				<input class="btn btn-primary btn-lg btn-block" type="submit" value="Frissítés" name="updateThisPet"><p></p>
				<?php
				echo " <input type='hidden' value='$petId' name='updatePet'>";
				?>
				<input class="btn btn-primary btn-lg btn-block" type="reset" value="Alaphelyzet" name="rs">
			</div>
		</form>

</div>
	
	
	
</body>
</html>

