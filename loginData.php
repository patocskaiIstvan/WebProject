<?php 
require_once("includes/db_config.php");	


if(isset($_POST["bejelentkezes"]))
{
	$email=$_POST["email"];
	$password=$_POST["password"];
	
	
	
	if(empty($email) || empty($password))
	{
		echo "<b class='p3'>Minden mezőt töltsön ki!</b><br>";
	}
	else
	{
		$sql = "select * from signedup where email = :email";
		$query=$connect->prepare($sql);
		$query->bindValue(':email', $email);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_ASSOC);
		$_SESSION['email'] = $email;
		if(!empty($result) && password_verify($password, $result["password"]))
		{
			
			echo "<b class='b2'>Sikeresen bejelentkezett!<br>" . $_SESSION['email'] ."</b><br>";
		}
		else
		{
			echo "<br><b class='p3'>Hibás email-cím vagy jelszó!</b><br>";
		}
	}
}



?>