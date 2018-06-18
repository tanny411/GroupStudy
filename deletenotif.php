<?php
require('connect.inc.php');
ob_start();
session_start();

if(isset($_POST['id']) && !empty($_POST['id'])){
    $id=$_POST['id'];
    $query="delete from notifs where id='".$id."'";
    if(!mysqli_query($con,$query)) die('Server Error');
}
else if(isset($_POST['groupid']) && !empty($_POST['groupid']) && isset($_POST['userid']) && !empty($_POST['userid'])){
    $groupid=$_POST['groupid'];
    $userid=$_POST['userid'];

    $query="delete from notifs where group_id='".$groupid."' and user_id='".$userid."'";
    if(!mysqli_query($con,$query)) die('Server Error');
}
else die('Error');

?>