<?php include ('header.php');
if ($_SESSION['role'] == 0) {
    echo "<h2 style='font-size:22px;padding:4px;text-align:center;'>Sorry, Permission denied.</h2>";
    die();
}
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading" style="font-weight: bold; color: #569dc7;">Add New Category:</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <form method="POST" autocomplete="off">
                    <div class="form-group">
                        <label style="color: #569dc7; ">Category Name:</label>
                        <input class="form-control" type="text" name="cat" placeholder="Category Name" required>
                    </div>
                    <button type="submit" class="btn btn-primary" id="save" name="save" style="background-color: #637c8a; "> Save </button>
                </form>
                <?php
                if (isset($_POST['save'])) {
                    $categoryname = $_POST['cat'];
                    $Npost = 0;
                    include ('config.php');
                    $query1 = mysqli_query($conn,"SELECT category_name FROM category WHERE category_name='$categoryname'");
                    if (mysqli_num_rows($query1) > 0) {
                        echo "<p style='color:red;font-size:18px;text-align:center;border:2px solid red;'>*Categoryname Already Exist</p>";
                    } 
                    else {
                        $query = mysqli_query($conn,"INSERT INTO category(category_name,post) VALUE('$categoryname','$Npost')");
                        header("Location: $hostname/admin/category.php");
                        mysqli_close($conn);
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include ('footer.php'); ?>