<div id="sidebar" class="col-md-4">
    <!-- search box -->
    <div class="search-box-container">
        <h4>Search</h4>
        <form class="search-post" action="search.php" method ="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search .....">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-danger">Search</button>
                </span>
            </div>
        </form>
    </div>
    <!-- /search box -->
    <!-- recent posts box -->
    <div class="recent-post-container">
        <h4>Recent Posts</h4>
        <?php
        include 'config.php';
                       
                        
                        $limit = 3;
                        
                        $sql = "SELECT post.post_id, post.title,post.post_date, post.post_img,
                        category.category_name, post.category FROM post
                        LEFT JOIN category ON post.category = category.category_id
                        ORDER BY post.post_id
                        DESC LIMIT {$limit}";
                        $query = mysqli_query($conn,$sql) OR die("recent post");
                        if(mysqli_num_rows($query) > 0){
                        while($data = mysqli_fetch_assoc($query)){



        ?>
        <div class="recent-post">
            <a class="post-img" href="single.php?id=<?php echo $data['post_id']; ?>">
                <img src="admin/upload/<?php echo $data['post_img']; ?>" alt=""/>
            </a>
            <div class="post-content">
                <h5><a href="single.php?id=<?php echo $data['post_id']; ?>"><?php echo $data['title'];  ?></a></h5>
                <span>
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    <a href='category.php?cid=<?php echo $data['category']; ?>'><?php echo $data['category']; ?></a>
                </span>
                <span>
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                    <?php echo $data['post_date'];  ?>
                </span>
                <a class="read-more" href="single.php?id=<?php echo $data['post_id']; ?>">read more</a>
            </div>
        </div>
    
    <?php
      }
     }

    ?>
    <!-- /recent posts box -->
</div>
