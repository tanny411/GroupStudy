<?php
require('connect.inc.php');
ob_start();
session_start();

if(isset($_POST['id']) && !empty($_POST['id'])){
    
    $id=$_POST['id'];
    //find fileid and userid
    $query="select file_id,user_id from comments where id='".$id."'";
    if(!$query_run=mysqli_query($con,$query)) die('Server Error');
    mysqli_data_seek($query_run,0);
	$row=mysqli_fetch_row($query_run);
    $userid=$row[1];
    $fileid=$row[0];

    //delete comment
    $query="delete from comments where id='".$id."'";
    if(!mysqli_query($con,$query)) die('Server Error');
    echo 'Deleted<br/>';

    //NOTIFICATION DELETING

    //finding owner of post
    $query=" select user_id from files where id='".$fileid."' ";
    if(!$query_run=mysqli_query($con,$query)) die('Server Error');
    mysqli_data_seek($query_run,0);
    $row=mysqli_fetch_row($query_run);
    $owner=$row[0];
    
    //delete owner notification
    if($owner!=$userid){
        //decrement if notif>1
        $query="select id,com_no from notifs where user_id='".$owner."' and  type='comment' and file_id='".$fileid."'";
        if(!$query_run=mysqli_query($con,$query)) die('Server Error');
        mysqli_data_seek($query_run,0);
        $row=mysqli_fetch_row($query_run);
        $num=$row[1];
        if($num>1){
            $query="update notifs set com_no = com_no - 1 where id='".$row[0]."'";
            if(!$query_run=mysqli_query($con,$query)) die('Server Error');
        }//else delete it
        else{
            $query="delete from notifs where id='".$row[0]."'";
            if(!$query_run=mysqli_query($con,$query)) die('Server Error');
        }
    }

    //delete follows
    $query=" select distinct user_id from comments where file_id='".$fileid."' ";
    if(!$query_run2=mysqli_query($con,$query)) die('Server Error');
    while($query_row=mysqli_fetch_assoc($query_run2)){
        $u=$query_row['user_id'];
        if($u!=$owner && $u!=$userid){
            //decrement if notif>1
            $query="select id,com_no from notifs where user_id='".$u."' and  type='follow' and file_id='".$fileid."'";
            if(!$query_run=mysqli_query($con,$query)) die('Server Error');
            mysqli_data_seek($query_run,0);
            $row=mysqli_fetch_row($query_run);
            $num=$row[1];
            if($num>1){
                $query="update notifs set com_no = com_no - 1 where id='".$row[0]."'";
                if(!$query_run=mysqli_query($con,$query)) die('Server Error'.mysqli_error($con));
            }//else delete
            else{
                $query="delete from notifs where id='".$row[0]."'";
                if(!$query_run=mysqli_query($con,$query)) die('Server Error');
            }
        }
    }
}
else die('Error');

?>