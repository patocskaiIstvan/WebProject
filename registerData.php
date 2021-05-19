<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	
	
	
	if(isset($_POST["register"]))
	{
		$fname=$_POST["fname"];
		$lname=$_POST["lname"];
		$email=$_POST["email"];
		$pw=$_POST["password"];
		$pw2=$_POST["pw2"];
				
		$fnameLength=strlen($fname);
		$lnameLength=strlen($lname);
				
		$pwLength=strlen($pw);
				
		$regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
		$domain = substr($email, strpos($email, '@') + 1);
							$sqlEmail = "select email from signedup where email= :email";
			$command=$connect->prepare($sqlEmail);
			$command->bindValue(":email", $email);
			$command->execute();
			$result=$command->fetch(PDO::FETCH_ASSOC);

				
		if(empty($fname) || empty($lname) || empty($email) || empty($pw) || empty($pw2))
		{
			echo "<b class='p3'>Minden mezőt töltsön ki!</b><br>";
		}
		elseif($pw !== $pw2)
		{
			echo "<p class='p3'>A jelszók nem egyeznek</p>";
		}
		elseif($fnameLength<4 || $lnameLength<4)
		{
			echo "<p class='p3'>A felhasználóneve legalább 4 betűből kell, hogy álljon!</p>";
		}
		elseif($pwLength<8)
		{
			echo "<p class='p3'>A jelszava legalább 8 karakterből kell, hogy álljon!</p>";
		}
		elseif(!preg_match($regex, $email))
		{
			echo "<p class='p3'>Helytelen e-mail cím formázás</p>";
		}
		elseif(checkdnsrr($domain) === FALSE)
		{
			echo "<p class='p3'>Az e-mail cím domainje helytelen</p>";
		}
		elseif($result)
		{
			echo "<p class='p3'>Ez az email már létezik!</p>";
		}
		else
		{
				
			$hashedPW=password_hash($pw, PASSWORD_BCRYPT);

			
			$sqlString="INSERT into signedup (fname, lname, email, password, signedUpDate) VALUES (:fName, :lName, :Email, :passWord, NOW())";
			$command=$connect->prepare($sqlString);
			$command->bindValue(":fName",$fname);
			$command->bindValue(":lName",$lname);
			$command->bindValue(":Email",$email);
			$command->bindValue(":passWord",$hashedPW);
			
			echo "<b class='b2'>Sikeresen regisztrált!</b><br>";
			
			require 'phpmailer/src/PHPMailer.php';
			require 'phpmailer/src/SMTP.php';
 
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
					
			$command->execute();
		}
	}
?>