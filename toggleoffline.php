<?php
ob_start();
session_start();
include('connect.inc.php');
if(!isset($_GET['val']) || empty($_GET['val']) ) die('Error!!');
$val=$_GET['val'];
$query="update user_group set offline='".$val."' where user_id='".$_SESSION['user_id']."' and group_id='".$_SESSION['group_id']."'";
if(!$query_run=mysqli_query($con,$query)) die('Database Error, sorry could not connect');
?>