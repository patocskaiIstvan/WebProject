<?php
require_once "../includes/db_config.php";
session_start();
if(isset($_POST['update']))
{
	/*
	$updateId = $_POST['updatePet'];
	header("location: updatePet.php?id=$updateId");
	*/
	
	$id=$_POST['updatePet'];
}
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
				<li class="nav-li"><a class="profile" href="login.php">PROFIL</a></li>
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
						let register = document.getElementsByClassName('nav-login-register');
						
						register[0].innerHTML= 'BEJELENTKEZVE';
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
				<li class="responsive-nav-li"><a class="responsive-nav-a" href="../index.php">HARMADIK</a></li>
				<li class="responsive-nav-li"><a class="responsive-nav-login-register" href="login.php">BEJELENTKEZÉS</a></li>
			</ul>
		</div>
	</div>
	
	<div class="profile-div">
		<img><br>
		<div>
		<?php 
		$email= $_SESSION['email'];
		$sql = "SELECT * FROM signedup WHERE email = :email";
		$query = $connect->prepare($sql);
		$query->bindValue(":email",$email);
		$query->execute();
		while($row = $query->fetch(PDO::FETCH_ASSOC)) 
		{
			$id = $row['id'];
			$fname = $row["fname"];
			$lname = $row["lname"];
			$date = $row["signedUpDate"];
			$isActivated = $row["activatedUser"];
			if($isActivated == 0)
			{
				$isActivated = "nincs aktiválva";
			}
			else if($isActivated == 1)
			{
				$isActivated = "aktiválva";
			}
			echo "
			<div class='user-profile'>
				<div><img src=''></div>
				<span class='sp1'>Felhasználói adatok</span><br><br>
				E-mail cím: $email<br>
				Teljes név: $lname $fname<br>
				Regisztrálás időpontja: $date<br>
				Fiók állapota: $isActivated<br>	
			</div>
			";
		}
		?>
		</div>
	</div>
	
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
	<div class='updateProf'>
    <p class='user-data'>Felhasználói adatok frissítése</p>
        <form method='post' action='updateProfile.php'>
            <?php
            if(isset($_POST["sb"]))
            {
                if(empty($_POST["fname2"]) && empty($_POST["lname2"]))
                {
                    echo "<b class='p3'>Töltsön ki minden mezőt!</b><br>";
                }
                else if(!empty($_POST["fname2"]) && !empty($_POST["lname2"]))
                {
                    $fn = $_POST["fname2"];
                    $ln = $_POST["lname2"];
                    $email = $_SESSION["email"];

                    $sql = "UPDATE signedup SET fname = :fname2, lname = :lname2 WHERE email = :email";
                    $q1 = $connect->prepare($sql);
                    $q1->bindValue(":fname2",$fn);
                    $q1->bindValue(":lname2",$ln);
                    $q1->bindValue(":email",$email);
                    $q1->execute();
                    echo "<br><b class='par1'>Sikeresen frissítve!</b><br>
                    <script>
                    setTimeout(goToProfile,1000);
                    function goToProfile()
                    {
                        window.location='profile.php';
                    }
                    </script>
                    ";

                }
            }


            ?>
            <label for='fname2' id='fm'>Keresztnév</label>
            <input type='text' id='fname2' name='fname2'><br><br>
            <label for='lname2' id='lm'>Vezetéknév</label>
            <input type='text' id='lname2' name='lname2'><br><br><br>
            <div class='btn-wrapper'>
                <input type='submit' name='sb' value='Frissítés' class='updateP'>
                <input type='reset' name='rs' value='Alaphelyzet' class='updateP'>
            </div>
        </form>
    </div>

</script>
<a href="#arrow" style='display:none;'>
<div><img class="arrow" src="../images/upArrow.png"></div>
	<div class="bottom-arrow">
		<div class="arrow-top"></div>
		<div class="arrow-shape"></div>
	</div>
</a>
</body>
</html>

