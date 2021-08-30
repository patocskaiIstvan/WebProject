<?php
class messageClass
{
	private $connect;
	public function __construct($connection)
	{
		$this->connect=$connection;
	}
	public function getMsg()
	{
		$email= $_SESSION['email'];
		$sql = "SELECT * FROM signedup WHERE email = :email";
		$query = $this->connect->prepare($sql);
		$query->bindValue(":email",$email);
		$query->execute();
		$result = $query->fetch();
		$id =  $result['id'];
		
		
		$sql2 = "SELECT * FROM MESSAGES INNER JOIN signedup ON signedup.id = messages.sender_id WHERE receiver_id = :id";
		$query2 = $this->connect->prepare($sql2);
		$query2->bindValue(":id",$id);
		$query2->execute();
		$result2 =$query2->fetchAll(); 
		$i = 0;
		foreach($result2 as $res)
		{
			$sender = $res['fname']." ".$res['lname'];
			$msg = $res['msg'];
			$date = $res['sentDate'];
			$email = $res['email'];
			
			echo "<div class='msg'>
				Feladó: $sender<br>
				Üzenet: $msg<br>
				Küldés Időpontja: $date<br>
				Feladó E-mail címe: $email<br>
				<br>
			
			</div>
			";
			$i++;
		}
		echo "<div class='msg-counter'>Beérkezett üzenetei: $i</div>";
	}
}



?>