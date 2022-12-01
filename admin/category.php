<?php include ('header.php');
if ($_SESSION['role'] == 0) {
    echo "<h2 style='font-size:22px;padding:4px;text-align:center;'>Sorry, Permission denied!</h2>";
    die();
}
?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading" style="font-weight: bold; color: #569dc7;">All Categories:</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" style="background-color: #569dc7;" href="add_category.php">add category</a>
                <br />
            </div>
            <div class="col-md-12">
                <?php
                include ('config.php');
                $query = mysqli_query($conn, "SELECT * FROM category");
                if (mysqli_num_rows($query) > 0) {
                ?>
                    <table class="content-table">
                        <thead style="background-color: #0d787f;">
                            <th>No.</th>
                            <th>Category Name</th>
                            <th>No. of Posts</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php $id = 1;
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                                <tr>
                                    <td class='id'><?php echo  htmlentities($id); $id++; ?></td>
                                    <td><?php echo  htmlentities($row['category_name']); ?></td>
                                    <td><?php echo  htmlentities($row['post']); ?></td>
                                    <td class='edit'><a href='update_category.php?id=<?php echo  htmlentities($row['category_id']); ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href="delete_category.php?id=<?php echo  htmlentities($row['category_id']); ?>"><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php  }
                ?>
                <ul class='pagination admin-pagination'>
                    <li><a href='category.php?page=1' class='btn-primary active'>1</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include ('footer.php');
