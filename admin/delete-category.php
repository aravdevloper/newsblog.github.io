<?php

$id = $_GET['id'];


include "config.php";
$sql = "DELETE FROM category WHERE category_id = {$id}";
$query = mysqli_query($conn,$sql) OR die("query failed");
if($query) {
	header("Location: category.php");
}


?>