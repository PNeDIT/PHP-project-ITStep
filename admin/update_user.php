<?php
include ('header.php');
if ($_SESSION['role'] == 0) {
    echo "<h2 style='font-size:22px;padding:4px;text-align:center;'>Permission denied!</h2>";
    die();
}
include ('config.php');
if (isset($_POST['submit'])) {
    $user_id =  $_POST['user_id'];
    $page =  $_POST['page'];
    $fname = mysqli_real_escape_string($conn, $_POST['f_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['l_name']);
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $role =  mysqli_real_escape_string($conn, $_POST['role']);
    $query = "UPDATE user SET first_name='$fname',last_name='$lname',username='$user',role='$role' WHERE user_id='$user_id'";
    $query1 = mysqli_query($conn, "SELECT * FROM user WHERE username='$user'");
    if (mysqli_num_rows($query1) > 0) {
        while ($row1 = mysqli_fetch_array($query1)) {
            if ($user_id == $row1['user_id']) {
                $result = mysqli_query($conn, $query);
            } 
            else {
                echo "<p style='color:red;font-size:22px;text-align:center;border:2px solid red;'>Username Already Exists!</p>";
            }
        }
    } 
    else {
        $result = mysqli_query($conn, $query);
    }
    header("Location: $hostname/admin/users.php?id=$user_id&page=$page");
    mysqli_close($conn);
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading" style="font-weight: bold; color: #569dc7;">Update User Details:</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <?php include ('config.php');
                $id = $_GET['id'];
                $page = $_GET['page'];
                $query = mysqli_query($conn, "SELECT * FROM user WHERE user_id=$id");
                if (mysqli_num_rows($query) > 0) {
                    while ($row = mysqli_fetch_array($query)) {
                ?>
                        <form method="post">
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" value="<?php echo htmlentities($row['user_id']);  ?>">
                                <input type="hidden" name="page" class="form-control" value="<?php echo htmlentities($page);  ?>">
                            </div>
                            <div class="form-group">
                                <label style="color: #569dc7; ">First Name:</label>
                                <input type="text" name="f_name" class="form-control" value="<?php echo htmlentities($row['first_name']);  ?>" required>
                            </div>
                            <div class="form-group">
                                <label style="color: #569dc7; ">Last Name:</label>
                                <input type="text" name="l_name" class="form-control" value="<?php echo htmlentities($row['last_name']);  ?>" required>
                            </div>
                            <div class="form-group">
                                <label style="color: #569dc7; ">Username:</label>
                                <input type="text" name="username" class="form-control" value="<?php echo htmlentities($row['username']);  ?>" required>
                            </div>
                            <div class="form-group">
                                <label style="color: #569dc7; ">User Role:</label>
                                <select class="form-control" name="role" value="<?php echo htmlentities($row['role']); ?>">
                                    <?php
                                    if ($row['role'] == 1) {
                                        echo "<option value='0'>Normal User</option>
                                      <option value='1' selected>Admin</option>";
                                    } 
                                    else {
                                        echo "<option value='0' selected>normal User</option>
                                      <option value='1'>Admin</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <br/>
                            <button type="submit" class="btn btn-primary" id="submit "name="submit" style="background-color: #637c8a; "> Update </button>
                        </form>
                <?php }
                } ?>
            </div>
        </div>
    </div>
</div>
<?php include ('footer.php'); ?>