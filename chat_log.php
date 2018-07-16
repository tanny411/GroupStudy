<?php
require('connect.inc.php');
ob_start();
session_start();

$groupid=$_SESSION['group_id'];
$query="select username,text from chat where group_id='".$groupid."'";
if(!$query_run=mysqli_query($con,$query)) die('Server Error');

while($query_row=mysqli_fetch_assoc($query_run)){
    echo "<li><b>".$query_row['username']."</b>: ".$query_row['text']."</li>";
}
?>