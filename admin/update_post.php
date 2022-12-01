<?php include ('header.php');  ?>
<?php
if ($_SESSION['role'] == 0) {
  include ('config.php');
  $post_id = $_GET['id'];
  $query2 = mysqli_query($conn, "SELECT author FROM post WHERE post_id='$post_id'");
  $row2 = mysqli_fetch_assoc($query2);
  if ($_SESSION['userid'] !== $row2['author']) {
    header("location:$hostname/admin/post.php");
  }
}

if (isset($_POST['submit'])) {
  header("location:$hostname/admin/post.php");
  include ('config.php');
  $id = $_POST['post_id'];
  $Ntitle = mysqli_real_escape_string($conn, $_POST['post_title']);
  $Ndesc = mysqli_real_escape_string($conn, $_POST['postdesc']);
  $Ncategory = $_POST['category'];
  $date = date("d M, Y");
  $author = $_SESSION['userid']; 
  $query = mysqli_query($conn, "UPDATE post SET title='$Ntitle', description='$Ndesc', category='$Ncategory', post_date='$date', author='$author' WHERE post_id='$id'");
}
?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="admin-heading" style="font-weight: bold; color: #569dc7;">Update Post:</h1>
      </div>
      <div class="col-md-offset-3 col-md-6">
        <?php
        $post_id = $_GET['id'];
        $query1 = mysqli_query($conn, "SELECT p.post_id,p.title,p.description,p.category,c.category_name,p.post_img FROM post p 
                  INNER JOIN category c ON p.category=c.category_id
                  INNER JOIN user ON p.author=user.user_id
                  WHERE p.post_id='$post_id'");
        if (mysqli_num_rows($query1) > 0) {
          while ($row = mysqli_fetch_array($query1)) {
        ?>
            <form method="post" enctype="multipart/form-data">
              <div class="form-group">
                <input type="hidden" name="post_id" class="form-control" value="<?php echo htmlentities($row['post_id']); ?>">
              </div>
              <div class="form-group">
                <label for="exampleInputTile" style="color: #569dc7; ">Title:</label>
                <input type="text" class="form-control" id="exampleInputUsername" value="<?php echo htmlentities($row['title']); ?>" name="post_title">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1" style="color: #569dc7; "> Description:</label>
                <textarea class="form-control" name="postdesc" required rows="6"><?php echo htmlentities($row['description']); ?>
                    </textarea>
              </div>
              <div class="form-group">
                <label for="exampleInputCategory" style="color: #569dc7; ">Category:</label>
                <input type="hidden" name="old-category" value="<?php echo htmlentities($row['category']); ?>">
                <select class="form-control" name="category" id="category">

                  <?php include ('config.php');
                  $sql1 = mysqli_query($conn, "SELECT * FROM category");
                  if (mysqli_num_rows($sql1) > 0) {
                    echo  "<option disabled > Select Category</option>";
                    while ($row1 = mysqli_fetch_array($sql1)) {
                      if ($row1['category_id'] == $row['category']) {
                        $select = "selected";
                      } 
                      else {
                        $select = "";
                      }
                  ?>
                      <option value='<?php echo htmlentities($row1['category_id']); ?>' <?php echo htmlentities($select); ?>><?php echo htmlentities($row1['category_name']); ?></option>
                  <?php }
                  }
                  ?>
                  <input type="hidden" name="old_category" value="1">
              </div>
              <div class="form-group">
                <label for="" style="color: #569dc7; ">Post image:</label>
                <input type="file" name="new-image">
                <img src="upload/<?php echo htmlentities($row['post_img']); ?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo htmlentities($row['post_img']); ?>">
              </div>
              <button type="submit" class="btn btn-primary" id="submit" name="submit" style="background-color: #637c8a; "> Update </button>
            </form>
        <?php
          }
        }
        mysqli_close($conn); ?>
      </div>
    </div>
  </div>
</div>
<?php

include ('footer.php');
?>