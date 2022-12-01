<?php 
include ('config.php');
$id= intval($_GET['id']);
$catg= intval($_GET['catid']);
$query="DELETE FROM post WHERE post_id='$id';";
$query.="UPDATE category SET post=post-1 WHERE category_id='$catg'";
$query2=mysqli_query($conn, "SELECT post_img FROM post WHERE post_id='$id'");
$row=mysqli_fetch_assoc($query2);
$img=$row['post_img'];
unlink("upload/".$img);
mysqli_multi_query($conn,$query);
header("Location: $hostname/admin/post.php");
mysqli_close($conn);
?>