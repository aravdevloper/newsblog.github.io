<?php
include "config.php";
if($_POST['submit']){




if(isset($_FILES['fileToUpload'])) {
  $errors = array();
  $file_name = $_FILES['fileToUpload']['name'];
  $file_size = $_FILES['fileToUpload']['size'];
  $file_tmp = $_FILES['fileToUpload']['tmp_name'];
  $file_type = $_FILES['fileToUpload']['type'];
  $file_one =  explode('.',$file_name );
  $file_ext =  end($file_one);
  $extension = array("jpeg","jpg","png");
  if($extension === FALSE){
  $errors[] = "this extension file not allowed Please choose JPG or PNG file";
  }
  if($file_size > 2097152) {
  $errors[] = "File size must be 2mb or lower";
  }
  $new_name = time(). "-".basename($file_name);
  $target = "upload/".$new_name;



  if(empty($errors) == true) {
  move_uploaded_file($file_tmp,"upload/".$target);
  }else{
  print_r($errors);
  die();
  }
  }

session_start();
$title = mysqli_real_escape_string($conn,$_POST['post_title']);
$description = mysqli_real_escape_string($conn,$_POST['postdesc']);
$category = mysqli_real_escape_string($conn,$_POST['category']);
$date = date("d M,Y");
$author = $_SESSION['user_id'];

$sql = "INSERT INTO post (title,description,category,post_date,author,post_img) VALUES('{$title}','{$description}','{$category}','{$date}',{$author},'{$new_name}');";
$sql .= "UPDATE category SET  post = post + 1 WHERE category_id = {$category}";
if(mysqli_multi_query($conn,$sql)){
header("Location: post.php");
} 
else{
	echo "<div class='alert alert-danger '>Query Failed</div>";
}
}

//$sql = "INSERT INTO post(title, description,category,post_date,author,post_img)
   //       VALUES('{$title}','{$description}',{$category},'{$date}',{$author},'{$new_name}');";
 // $sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$category}";

//"UPDATE category SET  post = post + 1 WHERE category_id = {category}";


?>