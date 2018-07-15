<?php
require('connect.inc.php');
ob_start();
session_start();

if(isset($_GET['userid'])&&isset($_GET['groupid'])&&isset($_GET['text'])&&!empty($_GET['userid'])&&!empty($_GET['groupid'])&&!empty($_GET['text'])){
    $text=$_GET['text'];
    $userid=$_GET['userid'];
    $groupid=$_GET['groupid'];
    $query="select Username from user where ID='".$userid."'";
    if(!$query_run=mysqli_query($con,$query)) die('Server Error');

    mysqli_data_seek($query_run,0);
    $row=mysqli_fetch_row($query_run);
    $name=$row[0];
    
    $query="insert into chat values('','".$groupid."','".$userid."','".$name."','".$text."',null)";
    if(!$query_run=mysqli_query($con,$query)) die('Server Error');
    
    $query="select username,text from chat where group_id='".$groupid."'";
    if(!$query_run=mysqli_query($con,$query)) die('Server Error');

    while($query_row=mysqli_fetch_assoc($query_run)){
        echo $query_row['username'].": ".$query_row['text']."<br/>";
    }

   
}
?>