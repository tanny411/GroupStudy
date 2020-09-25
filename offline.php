<?php
ob_start();
session_start();
include('connect.inc.php');
$query="update user_group set offline='1' where user_id='".$_SESSION['user_id']."' and group_id='".$_SESSION['group_id']."'";
if(!$query_run=mysqli_query($con,$query)) die('Database Error, sorry could not connect');
header('location: '.$_GET['next'].'.php');
?>