<?php
	
	
	if(isset($_POST["searchSubmit"]))
	{
		$searchVariable = $_POST['srchInput'];
		$sqlCommand2="SELECT * FROM pets INNER JOIN category ON pets.categoryId = category.categoryId WHERE type LIKE :type OR age LIKE :age OR status LIKE :status";
		$sqlQuery2=$connect->prepare($sqlCommand2);
		$sqlQuery2->bindValue(':type', '%'.$searchVariable.'%');
		$sqlQuery2->bindValue(':age', '%'.$searchVariable.'%');
		$sqlQuery2->bindValue(':status', '%'.$searchVariable.'%');
		$sqlQuery2->execute();
		$i=0;
		$count=0;
		while($row = $sqlQuery2->fetch(PDO::FETCH_ASSOC)) 
		{
			$i++;
			$id=$row["id"];
			$type=$row["type"];
			$status=$row["status"];
			$petAge=$row["age"];
			$image=$row["image"];
			$description=$row["description"];
		echo "
			<div class='pet'>
			<div class='pet-advertisement-caption'>
				Állat fajtája: $type<br>
				Állapota: $status<br>
				Életkor: $petAge<br><br>
			</div>
				<a href='petDescription.php?id=$id'><img class='img1' src='images/animals/$image' alt='hírdetés'></a>
			</div>";
			if($i==2)
			{
				echo "<h6></h6>";
				$i=0;
			}
		$count++;
		}
			echo "<div class='counter'>Állatok száma: $count</div>";
	}
	else if(!isset($_POST["searchSubmit"]))
	{
			$sqlCommand2="SELECT * FROM pets INNER JOIN category ON pets.categoryId = category.categoryId";
			$sqlQuery2=$connect->prepare($sqlCommand2);
			$sqlQuery2->execute();
			$i=0;
			$count=0;
		while($row = $sqlQuery2->fetch(PDO::FETCH_ASSOC)) 
		{
			$i++;
			$id=$row["id"];
			$type=$row["type"];
			$status=$row["status"];
			$petAge=$row["age"];
			$image=$row["image"];
			$description=$row["description"];
			echo "
			<div class='pet'>
			<div class='pet-advertisement-caption'>
				Állat fajtája: $type<br>
				Állapota: $status<br>
				Életkor: $petAge<br><br>
			</div>
				<a href='petDescription.php?id=$id'><img class='img1' src='images/animals/$image' alt='hírdetés'></a>
			</div>";
			if($i==2)
			{
				echo "<h6></h6>";
				$i=0;
			}
			$count++;
		}
		echo "<div class='counter'>Állatok száma: $count</div>";
	}
?>