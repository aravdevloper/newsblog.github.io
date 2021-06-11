<?php

include 'config.php';
$id = $_GET['id'];

$sql = "DELETE FROM user WHERE user_id = {$id}";
$query = mysqli_query($conn,$sql);
if($query){
 header("Location: users.php");
}else{
	echo "Can't Delete User Record";
}

?>