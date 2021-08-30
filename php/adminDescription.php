<?php
require_once "../includes/db_config.php";
session_start();
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Poiret+One&family=Ubuntu&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/styles.css">
	
    <title>Állat leírása</title>
</head>
<body>
<div class="admin-description-main-div">
<?php
		$id=$_GET["id"];
		$sqlCommand2="SELECT * FROM pets INNER JOIN category ON pets.categoryId = category.categoryId INNER JOIN status s ON pets.statusId = s.statusId WHERE id = :ID ";
		$sqlQuery2=$connect->prepare($sqlCommand2);
		$sqlQuery2->bindValue(":ID",$id);
		$sqlQuery2->execute();
		
		echo "
		<form method='post'>
			<input type='hidden' name='setid' value='$id'>
		</form>";
		
	while($row = $sqlQuery2->fetch(PDO::FETCH_ASSOC)) 
	{
		$type=$row["type"];
		$status=$row["status"];
		$petAge=$row["age"];
		$image=$row["image"];
		$description=$row["description"];
		$isActive = $row["active"];
		$email = $row["email"];
		$desc = $row["description"];


    echo "
		<div class='pet-description'>
		<div class='pet-description-caption'>
			<img class='img9' src='../images/animals/$image' alt='hírdetés'>
			<div class='caption'>
				<div class='caps'>
					<b>Hírdető</b>: <br><br>
					<b>Állat fajtája</b>: <br><br>
					<b>Állapota</b>: <br><br>
					<b>Életkor</b>: <br><br>
					<input class='cbox1' type='checkbox' name='chbox1'>
					<div class='cbox1-div'>
						<div class='slider1'>
							<div class='slider-dot'></div>
						</div>
					</div><br><br>
					<b>Leírás</b><br><br>
				</div>
				<div class='attr'>";
				if(empty($email))
				{
					$emptyMail = "amin@gmail.com";
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
						<a class='cbox-status'>Inaktív</a><br><br>
						<span class='animal-desc'>$desc</span>
					";
				}
				echo "
				</div>
			</div>
			<div class='save-div'>
				<form method='post' action='active.php'>
					<input type='hidden' value='$id' name='id'>
					<input type='hidden' name='isActive' value='$isActive' class='changeActivateState'>
					<input type='submit' value='Mentés' name='sbSave' class='sbSave'>
				</form>
			</div>
		</div>
		</div>";
	}
?>

</div>	
<script src="../JavaScript/petDesc.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</body>
</html>

