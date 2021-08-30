<?php
require_once "../includes/db_config.php";
if(isset($_POST['delete']))
{
	$id=$_POST['deletePet'];
	$deleteCommand = "DELETE FROM pets WHERE id=:id";

    $result = $connect->prepare($deleteCommand);
    $result->BindValue(":id",$id);

    $result->execute();
	echo "Deleted: $id";
	header("Location: profile.php");
}
?>
