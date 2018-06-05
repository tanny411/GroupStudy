<?php
include('connect.inc.php');
include('core.inc.php');

if(isset($_GET['text']) && !empty($_GET['text']))
	$text=mysqli_real_escape_string($con,$_GET['text']);
else $text="";

$query="select id,name from groups where name like '".$text."%' and id in(select group_id from user_group where user_id='".$_SESSION['user_id']."')";
$query_run=mysqli_query($con,$query);
if(!$query_run) die('query failed');
while($query_row=mysqli_fetch_assoc($query_run))
{
	echo $name='<li><a href="setsession.php?id='.$query_row['id'].'">'.$query_row['name'].'</a></li>';
}
?>