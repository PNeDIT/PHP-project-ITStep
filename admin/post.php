<?php
include ('header.php'); ?>

<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading" style="font-weight: bold; color: #569dc7;">All Posts:</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" style="background-color: #569dc7;" href="add_post.php">add post</a>
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
                if ($_SESSION['role'] == 1) {
                    $query = "SELECT p.post_id,p.title,p.category,c.category_name,p.post_date,user.username 
                    FROM post p 
                    INNER JOIN category c ON p.category=c.category_id
                    INNER JOIN user ON p.author=user.user_id
                    ORDER BY p.post_id DESC LIMIT {$offset},{$no_of_records_per_page}";
                } 
                else {
                    $query = "SELECT p.post_id,p.title,p.category,c.category_name,p.post_date,user.username 
                    FROM post p 
                    INNER JOIN category c ON p.category=c.category_id
                    INNER JOIN user ON p.author=user.user_id
                    WHERE p.author='{$_SESSION['userid']}'
                    ORDER BY p.post_id DESC LIMIT {$offset},{$no_of_records_per_page}";
                }
                $result = mysqli_query($conn, $query);
                if (mysqli_num_rows($result) > 0) {
                ?>
                    <table class="content-table">
                        <thead style="background-color: #0d787f;">
                            <th>No.</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Date</th>
                            <th>Author</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php while ($row = mysqli_fetch_array($result)) {
                                $style = "style=''";
                                if (isset($_GET['id'])) {
                                    if ($row['post_id'] == $_GET['id']) {
                                        $style = "style='background-color:yellow;'";
                                    } 
                                } 
                            ?>
                                <tr <?php echo htmlentities($style); ?>>
                                    <td class='id'><?php echo htmlentities($row['post_id']); ?></td>
                                    <td><?php echo htmlentities($row['title']); ?> </td>
                                    <td><?php
                                        echo htmlentities($row['category_name']); ?>
                                    </td>
                                    <td><?php echo htmlentities($row['post_date']); ?></td>
                                    <td><?php echo htmlentities($row['username']); ?></td>
                                    <td class='edit'><a href='update_post.php?id=<?php echo htmlentities($row['post_id']); ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete_post.php?id=<?php echo htmlentities($row['post_id']); ?>&catid=<?php echo htmlentities($row['category']); ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <?php
                } 
                else {
                    echo "<p style='color:red;font-size:22px;text-align:center;border:2px solid red;'>No posts found, be the first one to add a post!.</p>";
                }
                ?>
                <ul class="pagination admin-pagination" >
                    <?php
                    if ($_SESSION['role'] == 0) {
                        $query1 = "SELECT post_id FROM post WHERE author='{$_SESSION['userid']}'";
                    } 
                    else {
                        $query1 = "SELECT post_id FROM post";
                    }
                    $result1 = mysqli_query($conn, $query1);
                    if (mysqli_num_rows($result1) > 0) {
                        $total_page = mysqli_num_rows($result1);
                        $no_of_records_per_page = 10;
                        $offset = ceil($total_page / $no_of_records_per_page);
                    }
                    for ($i = 1; $i <= $offset; $i++) {
                        $active = "";
                        if ($page == $i) {
                            $active = "active";
                        }
                        echo ' <li class="' . $active . '"><a href="post.php?page=' . $i . '">' . $i . '</a></li>';
                    }
                    ?> </ul>
            </div>
        </div>
    </div>
</div>
<?php include ('footer.php'); ?>