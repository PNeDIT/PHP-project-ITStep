<?php include ('header.php');
if ($_SESSION['role'] == 0) {
    echo "<h2 style='font-size:22px;padding:4px;text-align:center;'>Sorry, Permission denied, admin only!.</h2>";
    die();
}
?>

<?php
if (isset($_POST['save'])) {
    include ('config.php');
    $realpassword = $_POST['password'];
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $query1 = mysqli_query($conn,"SELECT * FROM user WHERE username='$user'");
    if (mysqli_num_rows($query1) > 0) {
        echo "<p style='font-size:30px; text-align:center; color:red ; border:3px solid red;'>Username Already Exists!</p>";
    } 
    else {
        $query = mysqli_query($conn, "INSERT INTO user(first_name,last_name,username,password,role) VALUE('$fname','$lname','$user','$password','$role')");
        $query2 = mysqli_query($conn, "SELECT user_id FROM user WHERE username='$user'");
        while ($row = mysqli_fetch_array($query2)) {
            echo $newid = $row['user_id'];
            $query3 = mysqli_query($conn, "SELECT * FROM user");
            $no_of_records_per_page = 10;
            $lastpage = ceil(mysqli_num_rows($query3) / $no_of_records_per_page);
            header("Location: $hostname/admin/users.php?id=$newid&page=$lastpage");
        }
        mysqli_close($conn);
    }
} 
else {
    $fname = "";
    $lname = "";
    $user = "";
    $realpassword = "";
    $role = "";
}
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading" style="font-weight: bold; color: #569dc7;">Add User:</h1>
            </div>
            <div class="col-md-offset-3 col-md-6">
                <form method="post">
                    <div class="form-group">
                        <label style="color: #569dc7;">First Name:</label>
                        <input type="text" name="fname" value="<?php echo $fname; ?>" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label style="color: #569dc7;">Last Name:</label>
                        <input type="text" name="lname" value="<?php echo $lname; ?>" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label style="color: #569dc7;">Username:</label>
                        <input type="text" name="user" value="<?php echo $user; ?>" class="form-control" placeholder="Username" required>
                    </div>

                    <div class="form-group">
                        <label style="color: #569dc7;">Password:</label>
                        <input type="password" name="password" value="<?php echo $realpassword; ?>" class="form-control" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label style="color: #569dc7;">User Role:</label>
                        <select class="form-control" name="role">
                            <?php
                                echo " <option value='0' selected>Normal User</option>";
                                echo  "<option value='1'>Admin</option>";
                            ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary" id="save" name="save" style="background-color: #637c8a; "> Save </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include ('footer.php'); ?>