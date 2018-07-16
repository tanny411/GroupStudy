<?php

include('core.inc.php');
include('connect.inc.php');

$ret="";
$query="select user_id from user_group where group_id='".$_SESSION['group_id']."' and offline=0 and user_id!='".$_SESSION['user_id']."'";
if(!$query_run=mysqli_query($con,$query)) die('Server error!');
while($query_row=mysqli_fetch_assoc($query_run)){
    $ret.=$query_row['user_id'].' ';
}
echo $ret;
?>