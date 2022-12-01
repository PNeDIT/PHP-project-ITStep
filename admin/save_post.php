<?php
include ('config.php');
if (isset($_FILES['fileToUpload'])) {
    $filename = $_FILES['fileToUpload']['name'];
    $filetype = $_FILES['fileToUpload']['type'];
    $filetmp = $_FILES['fileToUpload']['tmp_name'];
    $filesize = $_FILES['fileToUpload']['size'];
    $fileext = substr($filetype, 0, strpos($filetype, "/"));
    if ($fileext == "image") {
        if ($filesize > 3145728) {
            echo "<p style='font-size:18px;padding:4px;color:red;'>File size is greater than 2MB, please use image size less than 2MB!</p>";
            die();
        } 
        else {
            $new_name = time() . "-" . basename($filename);
            move_uploaded_file($filetmp, "upload/" . $new_name);
        }
    } 
    else {
        echo "<p style='font-size:18px;padding:4px;color:red;'>Invalid extension, please use jpg/jpeg/png image extension!</p>";
        die();
    }
} 
else {
    echo "<p style='font-size:18px;padding:4px;color:red;'>Please upload image file.</p>";
    die();
}

session_start();
$title = mysqli_real_escape_string($conn, $_POST['post_title']);
$desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
$category = $_POST['category'];
$date = date("d M, Y");
$author = $_SESSION['userid'];
$sql = "INSERT INTO post(title,description,category,post_date,author,post_img) VALUE('$title','$desc','$category','$date','$author','$new_name');";
$sql .= "UPDATE category SET post=post+1 WHERE category_id='$category'";
if (mysqli_multi_query($conn, $sql)) {
    header("location:$hostname/admin/post.php");
}
?>