<?php
ob_start();
session_start();
require('connect.inc.php');
if(!isset($_SESSION['user_id']) || !isset($_SESSION['group_id']) || empty($_SESSION['group_id']) || empty($_SESSION['user_id'])) header('Location: main_page.php');
$query="select * from groups where id=".$_SESSION['group_id'];
if($query_run=mysqli_query($con,$query))
{
    mysqli_data_seek($query_run,0);
    $row=mysqli_fetch_row($query_run);
}else die('Server Error!');

if(isset($_POST['oldpass']) &&!empty($_POST['oldpass']) && mysqli_real_escape_string($con,$_POST['oldpass'])==$row[5])
{
    $pass=mysqli_real_escape_string($con,$_POST['pass']);
    $repeatpass=mysqli_real_escape_string($con,$_POST['repeatpass']);

    $grp_desc=mysqli_real_escape_string($con,$_POST['grp_desc']);
    $grp_name=mysqli_real_escape_string($con,$_POST['grp_name']);
    $time=mysqli_real_escape_string($con,$_POST['time']);

    $ok=false;

    if(!empty($pass)){
    if(!empty($repeatpass) && $pass==$repeatpass) $ok=true;
        else {
            $msg="<strong style=\"color:red\";>Passwords don't match</strong>";
        }
    }
    else {$ok=true; $pass=$row[5];}
    
    if($ok==true){
        if(empty($grp_desc)) $grp_desc=$user[2];
        if(empty($grp_name)) $grp_name=$user[1];
        if(empty($time)) $time=$user[3];

        $query="update groups set name='$grp_name',description='$grp_desc',validity='$time',pass='$pass' where id=".$row[0];
        if(!$query_run=mysqli_query($con,$query)) $msg="<strong style=\"color:red\";>There was a problem. Please try again.</strong>"; 
        else header('Location: grouppage.php');
    }
}
else $msg="Current Password must match!";

include('group_setting.html');
?>