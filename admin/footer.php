<!-- Footer -->



<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
               <?php
                  
                  include "config.php";
                        $sql = "SELECT * FROM settings";
                        $query = mysqli_query($conn,$sql) OR die("query failed");
                        if(mysqli_num_rows($query) > 0) {
                        while($data = mysqli_fetch_assoc($query)){

                  
                ?>
                <span><?php echo $data['footerdesc'];   ?></span>
                <?php
            }
        }
                ?>
            </div>
        </div>
    </div>
</div>
<!-- /Footer -->
</body>
</html>

          