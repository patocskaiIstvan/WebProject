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
	
	
	.div2, .div3{
		background-color:#0049cc; 
		padding:15px;
		width: 500px;
		position: relative;
		font-size: 20px;
		top: 2250px;
		background-color: #0049cc;
		border: 1px solid #ced4da;
		border-radius: .25rem;		
		box-shadow: 0 0 10px #0049cc;
		text-align: center;
	}
	.div3{
		top: 100px;
	}
	@media screen and (max-width: 570px) {
		.div3, .modify-categories{
			width: 80vw;
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
	<div class="container-fluid div3"><a class='anchor' href='adminLoggedIn.php'>Kategória Hozzáadása</a></div>
	<div class='modify-categories'>
		<form method='post' action='addCat.php'>
		<?php
		if(isset($_POST["addCategory"]))
		{
			if(!empty($_POST["add"]))
			{
				$type=$_POST["add"];
				$sql = "INSERT INTO category(type) VALUES(:type)";
				$q1 = $connect->prepare($sql);
				$q1->bindValue(":type",$type);
				$q1->execute();
				echo "<br><b class='par1'>Sikeresen hozzáadva!</b><br>";
			}
			else
			{
				echo "<b class='p3'>Töltse ki a mezőt!</b><br>";
			}
		}
		?>
		<label for="lbl-anml1"><b>Állat fajtája</b></label><br>
		<input type="text" name='add' class='form-control' style="background-color:#007bff; color:#fff;" id="lbl-anml1"><br><br>
			<input type='submit' value='Kategória Hozzáadása' class='btn btn-primary btn-lg btn-block' name='addCategory'>
		</form>
	
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
