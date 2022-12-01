<?php 
include ('config.php');
$id= intval($_GET['id']);
$query=mysqli_query($conn, "DELETE FROM user WHERE user_id='$id'");
header("Location: $hostname/admin/users.php");
mysqli_close($conn);
?>