<?php
session_start();
include ('config.php');
$_SESSION['login']=="";
session_unset();
session_destroy();
header("Location: $hostname/admin/");
?>