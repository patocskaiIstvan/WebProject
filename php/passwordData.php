<?php
require_once "../includes/db_config.php";


if(isset($_POST['ujJelszo']))
{
	$email=$_POST["email"];
	$password=$_POST["password"];
	$Newpassword=$_POST["password2"];
	if(empty($email) || empty($password || empty($Newpassword)))
	{
		echo "<b class='p3'>Minden mezőt töltsön ki!</b><br>";
	}
	else if($password !== $Newpassword)
	{
		echo "<b class='p3'>A jelszavak nem egyeznek!</b><br>";
	}
	else
	{
		$sql = "select * from signedup where email = :email";
		$query=$connect->prepare($sql);
		$query->bindValue(':email', $email);
		$query->execute();
		$result=$query->fetch(PDO::FETCH_ASSOC);
		$sql2 = "update signedup set password = :password WHERE email = :email";
		$query2=$connect->prepare($sql2);
		$hashedPW=password_hash($password,PASSWORD_BCRYPT);
		$query2->bindValue(':password',$hashedPW);
		$query2->bindValue(':email',$email);
		$query2->execute();
		echo "<b class='b2'>Sikeresen frissült jelszava!</b><br>";
	}
}


?>