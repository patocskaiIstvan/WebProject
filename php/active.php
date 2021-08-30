<?php
require_once "../includes/db_config.php";

$active = $_POST["isActive"];
$id = $_POST["id"];
echo $active;

$sql = "UPDATE pets SET active = :active WHERE id = :id";
$query=$connect->prepare($sql);
$query->bindValue(":active",$active);
$query->bindValue(":id",$id);
$query->execute();

$sql = "SELECT active FROM pets WHERE id = ".$id;
$query2 = $connect->prepare($sql);
$query2->execute();
$row = $query2->fetch();
$newActive = $row["active"];



header ("location: adminDescription.php?id=$id");

?>