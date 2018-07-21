<?php
ob_start();
session_start();
require('connect.inc.php');
$ret='<span class="sent">Invite Sent! ^_^ Want to invite more people?</span>';
if(isset($_POST['pass'])&&isset($_POST['msg'])&&isset($_POST['tag'])){
    if(!empty($_POST['pass'])&&!empty($_POST['tag'])){
        
        $groupid=$_SESSION['group_id'];

        $query="select * from groups where id='".$groupid."'";
        if(!$query_run=mysqli_query($con,$query)) die('<strong style="color:red;">Server Problem!</strong>');
        $query_row=mysqli_fetch_assoc($query_run);
        if($query_row['pass']!=$_POST['pass']) die('<strong style="color:red;">We\'re sorry, but your password is incorrect!</strong>');
        
        $tags_ara=explode("#",$_POST['tag'],-1);
        for($i=0 ;$i<count($tags_ara) ;$i++) 
        {
            $tag=$tags_ara[$i];
            $query="select id from invites where username='".$tag."' and group_id='".$groupid."'";
            if(!$query_run=mysqli_query($con,$query)) die('<strong style="color:red;">Server Problem!</strong>');
            $rows=mysqli_num_rows($query_run);
            if($rows>0) continue;
            $query="insert into invites values('','".$tag."','".$groupid."','".$_POST['msg']."')";
            if(!$query_run=mysqli_query($con,$query)) die('<strong style="color:red;">Server Problem!</strong>');
        }
    }
    else $ret="<strong style=\"color:red;\">Seems the fields weren't filled properly.</strong>";
}
else $ret="<strong style=\"color:red;\">Some Problem Occured!</strong>";
echo $ret;
?>