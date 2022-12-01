<?php
include ('config.php');
if (empty($_FILES['new-image']['name'])) {
    $new_name = $_POST['old-image'];
} 
else {
    echo $filename = $_FILES['new-image']['name'];
    $filetype = $_FILES['new-image']['type'];
    $filetmp = $_FILES['new-image']['tmp_name'];
    $filesize = $_FILES['new-image']['size'];
    $fileext = substr($filetype, 0, strpos($filetype, "/"));
    if ($fileext == "image") {
        if ($filesize > 3145728) {
            echo "<p style='font-size:18px;padding:4px;color:red;'>File size is greater than 2MB, please use image size less than 2MB!</p>";
            die();
        } 
        else {
            $modify_name = time() . "-" . basename($filename);
            $new_name = $modify_name;
            move_uploaded_file($filetmp, "upload/" . $new_name);
        }
    } 
    else {
        echo "<p style='font-size:18px;padding:4px;color:red;'>Invalid extension, please use jpg/jpeg/png image extension.</p>";
        die();
    }
}

session_start();
$post_id = $_POST['post_id'];
$title = mysqli_real_escape_string($conn, $_POST['post_title']);
$desc = mysqli_real_escape_string($conn, $_POST['postdesc']);
$category = $_POST['category'];
$old_category = $_POST['old-category'];
$new_name . "Line number 40";
$sql = "UPDATE post SET title='$title',description='$desc',category='$category',post_img='$new_name' WHERE post_id='$post_id';";
if ($old_category !== $category) {
    $sql .= "UPDATE category SET post=post+1 WHERE category_id='$category';";
    $sql .= "UPDATE category SET post=post-1 WHERE category_id='$old_category'";
}
if (mysqli_multi_query($conn, $sql)) {
    header("location:$hostname/admin/post.php?id=$post_id");
}
?>