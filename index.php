<?php include 'header.php'; ?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
                    <?php
                        include 'config.php';
                       
                        if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        
                        }else{
                        $page = 1;
                        }
                        $limit = 3;
                        $offset = ($page - 1)*$limit;
                        $sql = "SELECT post.post_id, post.title,post.description,post.post_date, post.post_img,post.author,
                        category.category_name,user.username, post.category FROM post
                        LEFT JOIN category ON post.category = category.category_id
                        LEFT JOIN user ON post.author = user.user_id
                        ORDER BY post.post_id
                        DESC LIMIT {$offset},{$limit}";
                        $query = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($query) > 0){
                        while($data = mysqli_fetch_assoc($query)){
                        
                    ?>

                        <div class="post-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?php echo $data['post_id'];?>"><img src="admin/upload/<?php echo $data['post_img']; ?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href="single.php?id=<?php echo $data['post_id']; ?>"><?php echo $data['title'];  ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?php echo $data['category']; ?>'><?php echo $data['category_name'];  ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php?aid=<?php echo $data['author']; ?>'><?php echo $data['username'];  ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?php echo $data['post_date'];  ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                            <?php echo  substr($data['description'],0,130) ."...";  ?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?php echo $data['post_id'];?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }else{
                    echo "Record Not Found";
                }

                        ?>

                        <?php
                  include 'config.php';

                        $sql = "SELECT * FROM post";
                        $query = mysqli_query($conn,$sql);
                        if(mysqli_num_rows($query) > 0){
                        $total_records = mysqli_num_rows($query);
                        
                        $total_page = ceil($total_records / $limit );

                        echo "<ul class='pagination admin-pagination'>";
                        if($page > 1){
                          echo '<li><a href="index.php?page='.($page-1).'">Prev</a></li>';
                        }
                        
                        for($i=1; $i <= $total_page; $i++){ 
                        if($i == $page) {
                        $active = "active";
                        }else{
                          $active = "";
                        }
                        echo '<li class="'.$active.'"><a  href="index.php?page='.$i.'">'.$i.'</a></li>';
                        

                          
                        }
                         if($total_page > $page ){
                         echo '<li><a href="index.php?page='.($page+1).'">Next</a></li>';
                          
                         }
                         
                        echo '</ul>';

                       }


                  ?>
                    </div><!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>