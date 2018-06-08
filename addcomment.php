<?php
require('connect.inc.php');
ob_start();
session_start();

if(isset($_POST['groupid']) && !empty($_POST['groupid']) && isset($_POST['comment']) && !empty($_POST['comment']) && isset($_POST['fileid']) && !empty($_POST['fileid']) && isset($_POST['userid']) && !empty($_POST['userid']) && isset($_POST['name']) && !empty($_POST['name'])){
    $userid=$_POST['userid'];
    $groupid=$_POST['groupid'];
    $fileid=$_POST['fileid'];
    $comment=$_POST['comment'];
    $username=$_POST['name'];
    
    $query="insert into comments values('','".$groupid."','".$fileid."','".$userid."','".$comment."',null)";
    if(!$query_run=mysqli_query($con,$query)) die('Server Error');

    $comid = mysqli_insert_id($con);

    $query="select * from comments where id='".$comid."'";
    if(!$query_run=mysqli_query($con,$query)) die('Server Error');
    mysqli_data_seek($query_run,0);
    $row=mysqli_fetch_row($query_run);

    $row[4]=nl2br($row[4]);
    
    $response="<div class=\"comment-box\" id=\"".$comid."\"><div class=\"com-cross\">X</div><h4 class=\"author\">".$username."</h4><div class=\"time\">".$row[5]."</div>".$row[4]."</div>";

    echo $response;
}
else die('Error');

?>