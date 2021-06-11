<?php include "header.php";
include "config.php";
if($_SESSION["role"] == '0'){
  header("Location: post.php");
}

if(isset($_POST['sumbit'])) {
  # code...

$upd_id = mysqli_real_escape_string($conn,$_POST['cat_id']);
$upd_name = mysqli_real_escape_string($conn,$_POST['cat_name']);
$sql1 = "UPDATE category SET category_name = '{$upd_name}' WHERE category_id = {$upd_id}";


 $query1 = mysqli_query($conn,$sql1) OR die("query failed");

if ($query1) {
    header("Location: category.php");
  }
  
 }


 ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                <?php
                
                $id = $_GET['id'];
                $sql = "SELECT * FROM category WHERE category_id = {$id}";
                $query = mysqli_query($conn,$sql) OR die("query failed");
                if(mysqli_num_rows($query) > 0) {
                while($data = mysqli_fetch_assoc($query)) {

                ?>
                  <form action="<?php  $_SERVER['PHP_SELF'];  ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $data['category_id'];  ?>" placeholder="">
                      </div>
                      <div class="form-group">

                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $data['category_name'];  ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="sumbit" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php
                }
              }
                  ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
