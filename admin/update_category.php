<?php
include ('header.php');
if ($_SESSION['role'] == 0) {
  echo "<h2 style='font-size:22px;padding:4px;text-align:center;'>Permission denied.</h2>";
  die();
}
?>
<div id="admin-content">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1 class="adin-heading" style="font-weight: bold; color: #569dc7;">Update Category:</h1>
      </div>
      <div class="col-md-offset-3 col-md-6">
        <?php
        $id = $_GET['id'];
        include ('config.php');
        $query = mysqli_query($conn, "SELECT * FROM category WHERE category_id='$id'");
        while ($row = mysqli_fetch_array($query)) {
        ?>
          <form method="post">
            <div class="form-group">
              <input type="hidden" name="id" class="form-control" value="<?php echo htmlentities($id); ?>">
              <input type="text" name="cat" class="form-control" value="<?php echo htmlentities($row['category_name']); ?>" disabled>
              <input type="number" name="post" class="form-control" value="<?php echo htmlentities($row['post']); ?>">
            </div>
            <div>
              <br/>
              <button type="submit" class="btn btn-primary" id="submit" name="submit" style="background-color: #637c8a; "> Update </button>
            </div>
          </form>
        <?php } ?>
      </div>
    </div>
  </div>
</div>
<?php
if (isset($_POST['submit'])) {
  include ('config.php');
  $Npost = $_POST['post'];
  $id = $_POST['id'];
  $query = mysqli_query($conn, "UPDATE category SET post='$Npost' WHERE category_id='$id'");
  header("Location: $hostname/admin/category.php");
  mysqli_close($conn);
}
?>
<?php include ('footer.php') ?>