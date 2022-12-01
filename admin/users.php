<?php include ('header.php');
if ($_SESSION['role'] == 0) {
    echo "<h2 style='font-size:22px;padding:4px;text-align:center;'>Permission denied!</h2>";
    die();
}
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading" style="font-weight: bold; color: #569dc7;">All Users:</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" style="background-color: #569dc7;" href="add_user.php">add user</a>
                <br />
            </div>
            <div class="col-md-12">
                <?php
                include ('config.php');
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } 
                else {
                    $page = 1;
                }
                $no_of_records_per_page = 10;
                $offset = ($page - 1) * $no_of_records_per_page;
                $query = mysqli_query($conn, "SELECT * FROM user ORDER BY user_id ASC LIMIT {$offset},{$no_of_records_per_page}");
                if (mysqli_num_rows($query) > 0) {
                ?>
                    <table class="content-table">
                        <thead style="background-color: #0d787f;">
                            <th>No.</th>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($query)) {
                                $style = "style=''";
                                if (isset($_GET['id']) && $row['user_id'] == $_GET['id']) {
                                    $style = "style='background-color:yellow;'";
                                } 
                            ?>
                                <tr <?php echo htmlentities($style); ?>>
                                    <td class='id'><?php echo htmlentities($row['user_id']); ?></td>
                                    <td><?php echo $row['first_name'] . " " . $row['last_name'] ?></td>
                                    <td><?php echo htmlentities($row['username']); ?></td>
                                    <td><?php
                                        if ($row['role'] == 1) {
                                            echo htmlentities("Admin");
                                        } 
                                        else {
                                            echo htmlentities("Normal");
                                        } ?></td>
                                    <td class='edit'><a href="update_user.php?id=<?php echo htmlentities($row['user_id']); ?>&page=<?php echo htmlentities($page); ?>"><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href="delete_user.php?id=<?php echo htmlentities($row['user_id']); ?>&page=<?php echo htmlentities($page); ?>"><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php
                } 
                else {
                    echo "<p style='color:red;font-size:22px;text-align:center;border:2px solid red;'>No users, add the first user!</p>";
                }
                ?>
                <ul class="pagination admin-pagination">
                    <?php
                    $query1 = mysqli_query($conn, "SELECT * FROM user");
                    if (mysqli_num_rows($query1) > 0) {
                        $total_page = mysqli_num_rows($query1);
                        $no_of_records_per_page = 10;
                        $offset = ceil($total_page / $no_of_records_per_page);
                    }
                    for ($i = 1; $i <= $offset; $i++) {
                        $active = "";
                        if ($page == $i) {
                            $active = "active";
                        }
                        echo ' <li class="' . $active . '"><a href="users.php?page=' . $i . '">' . $i . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include ('footer.php');
?>