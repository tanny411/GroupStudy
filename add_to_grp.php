<?php
ob_start();
session_start();
require('connect.inc.php');
if(isset($_GET['grp']) && !empty($_GET['grp']) && isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) ){
    $grpid=$_GET['grp'];
    $userid=$_SESSION['user_id'];
    $query="insert into user_group values ('".$userid."','".$grpid."',1)";
    if(!mysqli_query($con,$query)) die('Server Error!');
}
else die('Error!');
?>