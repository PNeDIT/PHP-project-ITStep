<?php include ('config.php');
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: $hostname/admin/");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Admin Panel</title>

    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="../css/font-awesome.css" />
    <link rel="stylesheet" href="../css/style.css" />
</head>
<body>
    <div id="header-admin" style="background-color: #637c8a;">
        <div class="container">
            <div class="row">
                <div class="col-md-2">
                    <a href="post.php"><img class="logo" src="images/bbc-news-logo.png"></a>
                </div>
                <div class="col-md-offset-6  col-md-4">
                    <span class="admin-logout" style="text-decoration: none;">Hello <?php echo $_SESSION['username'] ?> -</span><span> </span><button class="btn btn-primary"><a href="logout.php" class="admin-logout"> logout</a></button>
                </div>
            </div>
        </div>
    </div>

    <div id="admin-menubar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="admin-menu">
                        <li>
                            <a href="post.php" style="color: #637c8a">Post</a>
                        </li>
                        <?php
                        if ($_SESSION['role'] == 1) {
                        ?>
                            <li>
                                <a href="category.php" style="color: #637c8a">Category</a>
                            </li>
                            <li>
                                <a href="users.php" style="color: #637c8a">Users</a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>