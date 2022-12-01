<?php include ('header.php'); ?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading" style="font-weight: bold; color: #569dc7; ">Add New Post:</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <form action="save_post.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="post_title" style="color: #569dc7; "> Post Title:</label>
                        <input type="text" class="form-control" name="post_title" placeholder="Enter title" required>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="exampleInputPassword1" style="color: #569dc7; ">Post Description:</label>
                        <textarea class="form-control" name="postdesc" rows="5" required></textarea>
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="exampleInputPassword1" style="color: #569dc7; ">Category:</label>
                        <select class="form-control" name="category">
                            <?php include ('config.php');
                            $sql = mysqli_query($conn,"SELECT * FROM category");
                            if (mysqli_num_rows($sql) > 0) {
                                echo  "<option disabled selected> Select Category</option>";
                                while ($row = mysqli_fetch_array($sql)) {
                                    ?>
                                    <option value='<?php echo htmlentities($row['category_id']); ?>'><?php echo htmlentities($row['category_name']); ?></option>
                          <?php }
                            }
                            mysqli_close($conn);
                          ?>
                        </select>
                    </div>
                    <br />
                    <div class="form-group" style="clear: right">
                        <label for="exampleInputPassword1" style="color: #569dc7; ">Post image:</label>
                        <input type="file" class="form-control" id="fileToUpload" name="fileToUpload" required>
                    </div>
                    <br />
                    <button type="submit" class="btn btn-primary" id="submit" name="submit" style="background-color: #637c8a; "> Save </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include ('footer.php'); ?>