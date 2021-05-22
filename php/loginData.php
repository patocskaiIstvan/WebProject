<?php 
require_once("../includes/db_config.php");	

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
		if(!empty($result) && password_verify($password, $result["password"]))
		{
			$_SESSION['email'] = $email;
			echo "<b class='b2'>Sikeresen bejelentkezett!<br>" . $_SESSION['email'] ."<br><button class='logout-button' name='logout'>Kijelentkezés</button></b><br>
			<script>
			let register = document.getElementsByClassName('nav-login-register');
						
			register[0].innerHTML= 'BEJELENTKEZVE';
			</script>
			";
		}
		else
		{
			echo "<br><b class='p3'>Hibás email-cím vagy jelszó!</b><br>";
		}
	}
}

if(isset($_SESSION['email']) && empty($result))
{
	echo "<b class='b2'>Sikeresen bejelentkezett!<br>" . $_SESSION['email'] ."<br><button class='logout-button' name='logout'>Kijelentkezés</button></b><br>
	<script>
	document.getElementsByClassName('nav-login-register')[0].innerHTML= 'BEJELENTKEZVE';	
	
	</script>
	";
	if(isset($_POST['logout']))
	{
		session_destroy();
		header("location: login.php");
	}
}



?>