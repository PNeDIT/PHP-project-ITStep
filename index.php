<?php include('header.php'); ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="post-container">
                    <?php
                    include "config.php";
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                    } 
                    else {
                        $page = 1;
                    }
                    $no_of_records_per_page = 10;
                    $offset = ($page - 1) * $no_of_records_per_page;
                    $query = "SELECT p.post_id,p.title,p.category,p.description,p.post_img ,c.category_name,p.post_date,user.username,user.user_id FROM post p INNER JOIN category c
                              ON p.category=c.category_id
                              INNER JOIN user
                              ON p.author=user.user_id
                              ORDER BY p.post_id DESC LIMIT {$offset},{$no_of_records_per_page}";
                    $result = mysqli_query($conn, $query);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                            <div class="post-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <a class="post-img" href="single.php?id=<?php echo htmlentities($row['post_id']); ?>"><img src="admin/upload/<?php echo htmlentities($row['post_img']); ?>" alt="<?php echo htmlentities($row['title']);?>" /></a>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="inner-content clearfix">
                                            <h3><a href='single.php?id=<?php echo htmlentities($row['post_id']); ?>'><?php echo htmlentities($row['title']); ?></a></h3>
                                            <div class="post-information">
                                                <span>
                                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                                    <a href='category.php?cid=<?php echo htmlentities($row['category']); ?>'><?php echo htmlentities($row['category_name']); ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-user" aria-hidden="true"></i>
                                                    <a href='author.php?aid=<?php echo htmlentities($row['user_id']); ?>'><?php echo htmlentities($row['username']); ?></a>
                                                </span>
                                                <span>
                                                    <i class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($row['post_date']); ?>
                                                </span>
                                                </span>
                                            </div>
                                            <p class="description">
                                                <?php echo substr($row['description'], 0, 190) . "..."; ?>
                                            </p>
                                            <a class='read-more pull-right' href='single.php?id=<?php echo htmlentities($row['post_id']); ?>'>read more</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php }
                    } 
                    else {
                        echo "<p style='color:red;font-size:22px;text-align:center;border:2px solid red;'>Add new post! No records found!</p>";
                    }
                    ?>
                    <ul class="pagination admin-pagination">
                        <?php
                        $query1 = "SELECT * FROM post";
                        $result1 = mysqli_query($conn, $query1);
                        $total_pages = mysqli_num_rows($result1);
                        $no_of_records_per_page = 10;
                        $offset = ceil($total_pages / $no_of_records_per_page);

                        for ($i = 1; $i <= $offset; $i++) {
                            $active = "";
                            if ($page == $i) {
                                $active = "active";
                            }
                            echo ' <li class="' . $active . '"><a href="index.php?page=' . $i . '">' . $i . '</a></li>';
                        }
                        ?> </ul>
                        
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>