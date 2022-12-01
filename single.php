<?php include('header.php'); ?>
<div id="main-content">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="post-container">
                    <div class="post-content single-post">
                        <?php
                        $post_id = $_GET['id'];
                        include('config.php');
                        $query = "SELECT p.post_id,p.title,p.category,p.description,p.post_img ,c.category_name,p.post_date,user.username,user.user_id FROM post p INNER JOIN category c
                                  ON p.category=c.category_id
                                  INNER JOIN user
                                  ON p.author=user.user_id
                                  WHERE p.post_id='$post_id'";
                        $currenturl="http://".$_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                        $result = $conn->query($query);
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                        ?>
                                <h3 style="color: #637c8a"><?php echo htmlentities($row['title']); ?></h3>
                                <div class="post-information">
                                    <span>
                                        <i style="color: #637c8a" class="fa fa-tags" aria-hidden="true"></i>
                                        <a href='category.php?cid=<?php echo htmlentities($row['category']); ?>'><?php echo htmlentities($row['category_name']); ?></a>
                                    </span>
                                    <span>
                                        |
                                        <b>Posted by: </b>
                                        <i style="color: #637c8a" class="fa fa-user" aria-hidden="true"></i>
                                        <a href='author.php?aid=<?php echo htmlentities($row['user_id']); ?>'><?php echo htmlentities($row['username']); ?></a>
                                    </span>
                                    <span>
                                        |
                                        <b>on:</b>
                                        <i style="color: #637c8a" class="fa fa-calendar" aria-hidden="true"></i><?php echo htmlentities($row['post_date']); ?>
                                    </span>
                                    <p><strong>Share:</strong> <a style="color:blue" href="http://www.facebook.com/share.php?u=<?php echo $currenturl;?>" target="_blank">Facebook</a> | 
                                        <a style="color:blue" href="https://twitter.com/share?url=<?php echo $currenturl;?>" target="_blank">Twitter</a> |
                                        <a style="color:blue" href="https://web.whatsapp.com/send?text=<?php echo $currenturl;?>" target="_blank">Whatsapp</a> | 
                                        <a style="color:blue" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $currenturl;?>" target="_blank">Linkedin</a>
                                    </p>
                                </div>
                                <img class="single-feature-image" src="admin/upload/<?php echo htmlentities($row['post_img']); ?>" alt="<?php echo htmlentities($row['title']);?>" />
                                <p class="description">
                                    <?php echo $row['description']; ?>
                                </p>
                        <?php }
                        } 
                        else {
                            echo "no results";
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>