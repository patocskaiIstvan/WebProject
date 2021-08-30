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
				<li class="nav-li"><a class="profile" href="php/profile.php">PROFIL</a></li>
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
						document.getElementsByClassName('nav-login-register')[0].innerHTML = 'BEJELENTKEZVE';
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
	
	<div class="msg-form">
		<form method="POST" action="msg.php">
		<?php
	if(isset($_POST['sendMsg']))
	{
		$email = $_POST["email2"];
		$msg = $_POST["msg"];

		if(empty($email) || empty($msg))
		{
			echo "<br><b class='p3'>Minden mezőt töltsön ki!</b><br>";
		}
		else if(!empty($email) || !empty($msg))
		{
			$sql1 = "SELECT id FROM signedup WHERE email = :email";
			$query1 = $connect->prepare($sql1);
			$query1->bindValue(":email",$email);
			$query1->execute();
			$result = $query1->fetch();
			$id2 = $result['id'];
			if($id2==null)
			{
				echo "<br><b class='p3'>Hibás email cím!</b><br>";
			}
			else if($email == $_SESSION["email"])
			{
				echo "<br><b class='pY'>Saját magának akar írni?</b><br>";
			}
			else
			{
				$sqlSenderId = "SELECT id FROM signedup WHERE email = :email2";
				$q2 = $connect->prepare($sqlSenderId);
				$q2->bindValue(":email2",$_SESSION["email"]);
				$q2->execute();
				$row = $q2->fetch();
				$id = $row["id"];


				$sql = "INSERT INTO messages(sender_id,receiver_id,msg,sentDate) VALUES(:sender_id, :receiver_id, :msg, now())";
				$query = $connect->prepare($sql);
				$query->bindValue(":sender_id",$id);
				$query->bindValue(":msg",$msg);
				$query->bindValue(":receiver_id",$id2);
				$query->execute();
				echo "<br><b class='par1'>Sikeresen elküldve!</b><br>";
			}
				
		}
		else
		{
			echo "<br><b class='p3'>Hibás adatok!</b><br>";
		}
				
	}
	if(!isset($_SESSION["email"])){
		echo "<script>
		window.location='login.php';
		</script>";
	}
			
	?>
			<label class="lbl1">Felhasználó e-mail címe</label>
			<input class="msg-input" type="email" name="email2"><br><br>
			<label class="lbl1">Üzenet</label>
			<textarea class="text1" name="msg"></textarea><br>
			<input class="msg-button" type="submit" name="sendMsg" value="Küldés">
		</form>
	</div>
	
	<div class="msg-div">
	<?php 
		require_once "../messageClass.php";
		$messageClass = new messageClass($connect);
		$messageClass->getMsg();
	?>
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

