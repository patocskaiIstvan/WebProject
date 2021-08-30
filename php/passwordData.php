<?php
require_once "../includes/db_config.php";
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

		require '../phpmailer/src/PHPMailer.php';
		require '../phpmailer/src/SMTP.php';

		$mail = new PHPMailer(true);
		try 
		{
			$string = "http://" . $_SERVER["HTTP_HOST"] . dirname($_SERVER["PHP_SELF"]) . "/activation.php?link=".$email;
			$mail->isSMTP();                                            
			$mail->Host       = 'smtp.gmail.com';                     
			$mail->SMTPAuth   = true;                                   
			$mail->Username   = 'wproject666@gmail.com';                    
			$mail->Password   = 'notwebproject';                           
			$mail->SMTPSecure = 'ssl';       
			$mail->Port       = 465;                                   

			$mail->setFrom('from@example.com', 'Mailer');
			$mail->addAddress($email);              

			$mail->isHTML(true);                              
			$mail->Subject = 'Here is the subject';
			$mail->Body    = 'This is your code:'.$string;
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
			echo "<b class='b2'>E-mail elküldve!</b><br><br>";
		} catch (Exception $e) 
			{
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
				
		$query2->execute();

	}
}


?>