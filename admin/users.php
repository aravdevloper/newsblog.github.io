<?php include "header.php";
//session_start();
if($_SESSION['role'] == '0') {
  header("Location: http://localhost/news-blog/admin/post.php");
}

 ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <tbody>
                        <?php
                        include 'config.php';
                       
                        if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        
                        }else{
                        $page = 1;
                        }
                        $limit = 3;
                        $offset = ($page - 1)*$limit;

                        $sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset},{$limit}";
                        $query = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($query) > 0){
                        while($data = mysqli_fetch_assoc($query)){
                        $fname = $data['first_name'];
                        $lname = $data['last_name'];
                        
                        ?>
                          <tr>
                              <td class='id'><?php echo $data['user_id'];  ?></td>
                              <td><?php echo $fname." ".$lname;  ?></td>
                              <td><?php echo $data['username'];  ?></td>
                              <td>
                              <?php
                              if($data['role'] == 0) {
                                 echo "Normal User";
                              }else{
                                  echo "Admin";
                              }

                              ?>
                              
                            </td>
                              
                              <td class='edit'><a href='update-user.php?id=<?php echo $data['user_id'];  ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?id=<?php echo $data['user_id'];  ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
                        }
                      }

                          ?>

                      </tbody>
                  </table>

                  <?php
                  include 'config.php';

                        $sql = "SELECT * FROM user";
                        $query = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($query) > 0){
                        $total_records = mysqli_num_rows($query);
                        
                        $total_page = ceil($total_records / $limit );

                        echo "<ul class='pagination admin-pagination'>";
                        if($page > 1){
                          echo '<li><a href="users.php?page='.($page-1).'">Prev</a></li>';
                        }
                        
                        for($i=1; $i <= $total_page; $i++){ 
                        if($i == $page) {
                        $active = "active";
                        }else{
                          $active = "";
                        }
                        echo '<li class="'.$active.'"><a  href="users.php?page='.$i.'">'.$i.'</a></li>';
                        

                          
                        }
                         if($total_page > $page ){
                         echo '<li><a href="users.php?page='.($page+1).'">Next</a></li>';
                          
                         }
                         
                        echo '</ul>';

                       }


                  ?>
                  
                      <!-- <li class="active"><a>1</a></li> -->
                      
                      
                  </ul>
              </div>
          </div>
      </div>
  </div>
<?php include "header.php"; ?>
