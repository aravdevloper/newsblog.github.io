<?php
include "config.php";
if($_GET['id']){
$id = $_GET['id'];// this post id

$cat_id = $_GET['catid'];

$sql1 = "SELECT * FROM post WHERE post_id = {$id}";
$query = mysqli_query($conn,$sql1) OR die("quey failed");
$row = mysqli_fetch_assoc($query);

unlink("upload/".$row['post_img']);


$sql = "DELETE FROM post WHERE post_id = {$id};";
$sql .= "UPDATE category SET  post = post - 1 WHERE category_id = {$cat_id}";
if(mysqli_multi_query($conn,$sql)){
header("Location: post.php");
} 
else{
	echo "<div class='alert alert-danger '>Query Failed</div>";
}


}


?>