<?php 
include ('config.php');
$id= intval($_GET['id']);
$query=mysqli_query($conn, "DELETE FROM category WHERE category_id='$id'");
header("Location: $hostname/admin/category.php");
mysqli_close($conn);
?>