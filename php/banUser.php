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
		.div3, .modify-categories, .modify-categories2{
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
    $banned= 0;
	$sql = "SELECT * FROM signedup WHERE banned = :banned";
	$result = $connect->prepare($sql);
    $result->bindValue(":banned",$banned);
	$result->execute();
	$i = 0;
	while($row = $result->fetch(PDO::FETCH_ASSOC))
	{	
		$Id[$i]['id'] = $row['id'];
		$type[$i]['email'] = $row['email'];
		$i++;
	}
	?>
	<div class="container-fluid div3"><a class='anchor'  href='adminLoggedIn.php'>Felhasználó Bannolása/Unbannolása</a></div>
	<div class='modify-categories'>
		<form method='post' action='banUser.php'>
		<?php
		if(isset($_POST["banUSer"]))
		{
			if(($_POST["userSelect"]) != '')
			{
				$user=$_POST["userSelect"];
                $ban = 1;
				$sql = "UPDATE signedup SET banned = :banned WHERE id = :id";
				$q1 = $connect->prepare($sql);
				$q1->bindValue(":id",$user);
                $q1->bindValue(":banned",$ban);
				$q1->execute();
				echo "<br><b class='par1'>Felhasználó Bannolva!</b><br>";
			}
			else
			{
				echo "<b class='p3'>Válasszon ki egy felhasználót!</b><br>";
			}
		}
		?>
		<label for="lbl-anml1"><b>Felhasználó</b></label><br>
			<select class="form-control" name="userSelect" style="background-color:#007bff; color:#fff;" id="lbl-anml1">
				<option class="animal-input" value=''>Válasszon egy felhasználót</option>
				<?php
					for($i=0; $i<count($Id); $i++)
					{
						echo "<option value='".$Id[$i]['id']."'>".$type[$i]['email']."</option>";
					}
				?>
			</select><br><br>
			<input type='submit' value='Felhasználó Bannolása' class='btn btn-primary btn-lg btn-block' name='banUSer'>
		</form>
	</div>

    <?php
	$Id2 = array(array());
	$type2 = array(array());
    $banned2= 1;
	$sql2 = "SELECT * FROM signedup WHERE banned = :banned";
	$result2 = $connect->prepare($sql2);
    $result2->bindValue(":banned",$banned2);
	$result2->execute();
	$i2 = 0;
	while($row = $result2->fetch(PDO::FETCH_ASSOC))
	{	
		$Id2[$i2]['id'] = $row['id'];
		$type2[$i2]['email'] = $row['email'];
		$i2++;
	}
    ?>
	<div class='modify-categories2'>
		<form method='post' action='banUser.php'>
		<?php
		if(isset($_POST["unBanUSer"]))
		{
			if(($_POST["userSelect2"]) != '')
			{
				$user=$_POST["userSelect2"];
                $ban = 0;
				$sql = "UPDATE signedup SET banned = :banned WHERE id = :id";
				$q1 = $connect->prepare($sql);
				$q1->bindValue(":id",$user);
                $q1->bindValue(":banned",$ban);
				$q1->execute();
				echo "<br><b class='par1'>Felhasználó Unbannolva!</b><br>";
			}
			else
			{
				echo "<b class='p3'>Válasszon ki egy felhasználót!</b><br>";
			}
		}
		?>
		<label for="lbl-anml1"><b>Felhasználó</b></label><br>
			<select class="form-control" name="userSelect2" style="background-color:#007bff; color:#fff;" id="lbl-anml1">
				<option class="animal-input" value=''>Válasszon egy felhasználót</option>
				<?php
					for($i=0; $i<count($Id2); $i++)
					{
						echo "<option value='".$Id2[$i]['id']."'>".$type2[$i]['email']."</option>";
					}
				?>
			</select><br><br>
			<input type='submit' value='Felhasználó Unbannolása' class='btn btn-primary btn-lg btn-block' name='unBanUSer'>
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
