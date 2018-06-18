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
    
    $response="<div class=\"comment-box\" id=\"com_".$comid."\"><div class=\"com-cross\">X</div><h4 class=\"author\">".$username."</h4><div class=\"time\">".$row[5]."</div>".$row[4]."</div>";

    echo $response;

    //NOTIFICATION SENDING

    //finding owner of post
    $query=" select user_id from files where id='".$fileid."' ";
    if(!$query_run=mysqli_query($con,$query)) die('Server Error');
    mysqli_data_seek($query_run,0);
    $row=mysqli_fetch_row($query_run);
    $owner=$row[0];
    
    //notify owner
    if($owner!=$userid){
        //increment if notif exists
        $query="select id from notifs where group_id='".$groupid."' and user_id='".$owner."' and  type='comment' and file_id='".$fileid."'";
        if(!$query_run=mysqli_query($con,$query)) die('Server Error');
        $rows=mysqli_num_rows($query_run);
        if($rows>0){
            mysqli_data_seek($query_run,0);
            $row=mysqli_fetch_row($query_run);
            $query="update notifs set com_no = com_no + 1 where id='".$row[0]."'";
            if(!$query_run=mysqli_query($con,$query)) die('Server Error'.mysqli_error($con));
        }//else make new entry
        else{
            $query="insert into notifs values ('','".$groupid."','".$owner."','comment','".$fileid."',1)";
            if(!$query_run=mysqli_query($con,$query)) die('Server Error');
        }
    }

    //notify others who commented here
    $query=" select distinct user_id from comments where file_id='".$fileid."' ";
    if(!$query_run2=mysqli_query($con,$query)) die('Server Error');
    while($query_row=mysqli_fetch_assoc($query_run2)){
        $u=$query_row['user_id'];
        if($u!=$owner && $u!=$userid){
            //increment if notif exists
            $query="select id from notifs where group_id='".$groupid."' and user_id='".$u."' and  type='follow' and file_id='".$fileid."'";
            if(!$query_run=mysqli_query($con,$query)) die('Server Error');
            $rows=mysqli_num_rows($query_run);
            if($rows>0){
                mysqli_data_seek($query_run,0);
                $row=mysqli_fetch_row($query_run);
                $query="update notifs set com_no = com_no + 1 where id='".$row[0]."'";
                if(!$query_run=mysqli_query($con,$query)) die('Server Error');
            }//else make new entry
            else{
                $query="insert into notifs values ('','".$groupid."','".$u."','follow','".$fileid."',1)";
                if(!$query_run=mysqli_query($con,$query)) die('Server Error');
            }
        }
    }
}
else die('Error');

?>