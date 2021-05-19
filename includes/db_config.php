<?php
try
{
	$connect = new PDO("mysql:dbname=pet;host=localhost","Igen","randomJelszo");
	$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	
}
catch (PDOException $e)
{
	exit("Connection failed: " . $e->getMessage());
}
?>