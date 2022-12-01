<?php include "config.php";
$page_name = basename($_SERVER['PHP_SELF']);
switch ($page_name) {
    case "single.php":
        if (isset($_GET['id'])) {
            $query = "SELECT title FROM post WHERE post_id='{$_GET['id']}'";
            $result = mysqli_query($conn, $query) or die("Single page query failed");
            $row = mysqli_fetch_assoc($result);
            $page_title = $row['title'] . " News";
        }
        break;
    case "author.php":
        if (isset($_GET['aid'])) {
            $query = "SELECT first_name,last_name FROM user WHERE user_id='{$_GET['aid']}'";
            $result = mysqli_query($conn, $query) or die("Single page query failed");
            $row = mysqli_fetch_assoc($result);
            $page_title = "News By " . $row['first_name'] . " " . $row['last_name'];
        }
        break;
    case "category.php":
        if (isset($_GET['cid'])) {
            $query = "SELECT category_name FROM category WHERE category_id='{$_GET['cid']}'";
            $result = mysqli_query($conn, $query) or die("Single page query failed");
            $row = mysqli_fetch_assoc($result);
            $page_title = $row['category_name'] . " News";
        }
        break;
    default:
        $page_title = "Home Page";
        break;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title> <?php echo $page_title; ?> </title>

    <link rel="stylesheet" href="css\bootstrap.min.css" />
    <link rel="stylesheet" href="css\font-awesome.css" />
    <link rel="stylesheet" href="css\style.css" />
</head>
<body>
    <div id="header" style="background-color: #637c8a;">
        <div class="container">
            <div class="row">
                <div class=" col-md-offset-4 col-md-4">
                    <a href="index.php" id="logo"><img src="admin/images/bbc-news-logo.png"></a> </div>
            </div>
        </div>
    </div>
    <div id="menu-bar">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="menu">
                        <?php include "config.php";
                        echo "  <li><a style='color: #637c8a' href='{$hostname}'>Home</a></li>";
                        $query=mysqli_query($conn,"select category_id,category_name from category") or die("Connection failed 28" . mysqli_connect_error());
                        while($row=mysqli_fetch_array($query)) { ?>
                            <li>
                                <a class='' style='color: #637c8a' href="category.php?cid=<?php echo htmlentities($row['category_id'])?>"><?php echo htmlentities($row['category_name']);?></a>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>
</html>