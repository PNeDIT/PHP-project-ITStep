<?php
session_start();

include ('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login page</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link rel="stylesheet" href="font/font-awesome-4.7.0/css/font-awesome.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div id="wrapper-admin" class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4">
                    <img class="logo" src="images/bbc-news-logo.png">
                    <h3 class="heading" style="font-weight: bold; color: #569dc7;">Admin login:</h3>
                    <form method="post">
                        <div class="form-group">
                            <label style="color: #569dc7; ">Username:</label>
                            <input class="form-control" type="text" name="username" placeholder="Username" required="" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label style="color: #569dc7; ">Password:</label>
                            <input class="form-control" type="password" name="password" placeholder="Password" required="" autocomplete="off">
                        </div>
                        <button class="btn btn-primary" type="submit" name="login">Log In</button>
                    </form>
                    <button class="btn btn-primary"><a href="../index.php"><i class="mdi mdi-home"></i> Back Home</a> </button>
                    <?php
                    include ('config.php');
                    if (isset($_POST['login'])) {
                        $username = $_POST['username'];
                        $password = md5($_POST['password']);
                        $query = mysqli_query($conn,"SELECT user_id,username,role FROM user WHERE (username='$username' && password='$password')");
                        if (mysqli_num_rows($query) > 0) {
                            while ($row = mysqli_fetch_array($query)) {
                                session_start();
                                $_SESSION['username'] = $row['username'];
                                $_SESSION['userid'] = $row['user_id'];
                                $_SESSION['role'] = $row['role'];
                            }
                        } 
                        else {
                            echo "<p style='font-size:18px;padding:15px;color: #a94442; background-color: #f2dede; border-color: #ebccd1; }'>Invalid Details: Username Or Password is not correct</p>";
                            die();
                        }
                        if ($_SESSION['role'] == 1) {
                            header("Location: $hostname/admin/users.php");
                        } 
                        else {
                            header("Location: $hostname/admin/post.php");
                        }
                        mysqli_close($conn);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>