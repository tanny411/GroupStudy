<?php
ob_start();
session_start();
$current_file=$_SERVER['SCRIPT_NAME'];
function logged()
{
	if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) return true;
	else return false;
}
function getfield($f)
{
	global $con;
	$query="select ".$f." from user where ID=".$_SESSION['user_id'];
	if($query_run=mysqli_query($con,$query))
	{
		mysqli_data_seek($query_run,0);
		$row=mysqli_fetch_row($query_run);
		return $row[0];
	}
}
function getUser()
{
	global $con;
	$query="select * from user where ID=".$_SESSION['user_id'];
	if($query_run=mysqli_query($con,$query))
	{
		mysqli_data_seek($query_run,0);
		$row=mysqli_fetch_row($query_run);
		return $row;
	}
}
function getsomeUser($name)
{
	global $con;
	$query="select * from user where Username='".$name."'";
	if($query_run=mysqli_query($con,$query))
	{
		mysqli_data_seek($query_run,0);
		$row=mysqli_fetch_row($query_run);
		return $row;
	}
}
?>