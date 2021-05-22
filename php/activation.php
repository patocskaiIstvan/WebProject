<?php
require_once "../includes/db_config.php";
session_start();


if(isset($_GET['link']) && !empty($_GET['link']))
{
	$link = $_GET['link'];
	
	$sqlCommand = "select email,activatedUser from signedup where email = :link and activatedUser = 0";
	$sqlQuery=$connect->prepare($sqlCommand);
	$sqlQuery->bindValue(":link", $link);
	$sqlQuery->execute();
	if($sqlQuery->rowCount()>0)
	{
		$sqlCommand2 = "update signedup set activatedUser = 1 where email = :email";
		$sqlQuery2=$connect->prepare($sqlCommand2);
		$sqlQuery2->bindValue(":email", $link);
		$sqlQuery2->execute();
	}
	else
	{
		echo "
		<div class='main-link-div'>
			<div class='success'> Helló \"".$link."\"<br><br>
				A fiókja sikeresen aktiválva!
			</div>
			<a class='back-to-home' href='index.php'>VISSZA A FŐOLDALRA</a>
		</div>
		";
	}
}
else
{
	header("location: ../index.php");
}



?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
	<link rel="stylesheet" href="styles.css">
</head>
<body>
</body>
</html>
