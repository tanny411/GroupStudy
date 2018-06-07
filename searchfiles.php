<?php
require('connect.inc.php');
ob_start();
session_start();

if(isset($_POST['x']) && !empty($_POST['x']) && isset($_POST['groupid']) && !empty($_POST['groupid']) && isset($_POST['rand']) && !empty($_POST['rand'])){
    $x= $_POST['x'];
    $groupid= $_POST['groupid'];
    $separator=$_POST['rand'];
    
    $Send="";
    $msg="<i>No files found</i>";

    //USERLIST
    $query="select user_id from user_group where group_id='".$groupid."'";
	if($query_run=mysqli_query($con,$query)){
		while($query_row=mysqli_fetch_assoc($query_run)){
			$id=$query_row['user_id'];
			$query="select Username from user where ID='".$id."'";
			if($query_run2=mysqli_query($con,$query)){
				mysqli_data_seek($query_run2,0);
				$row=mysqli_fetch_row($query_run2);
				$name=$row[0];
				//assoc save
				$allusers[$id]=$name;
			}
			else die('Server Error');
		}
	}
    else die('Server Error');
    
    //TAGS
    $fileid=array();
    $query="select file_id from tags where group_id='".$groupid."' and tag='".$x."'";
    if(!$query_run=mysqli_query($con,$query)) die('Server Error');
    while($query_row=mysqli_fetch_assoc($query_run)){
        $fileid[]=$query_row['file_id'];
    }

    $list="";

    for($i=0;$i<count($fileid);$i++){
        $id=$fileid[$i];
        $query="select * from files where id='".$id."'";
	    if(!$query_run=mysqli_query($con,$query)) die('Server Error');
        while($query_row=mysqli_fetch_assoc($query_run)){
            $list.=" <div class=\"apost\">
            <h3 class=\"author\">".$allusers[$query_row['user_id']]."</h3>
            <div class=\"time\">".$query_row['timestamp']."</div>
            <div class=\"aposttext\">".$query_row['post']."</div>
            <div class=\"file-folder\">".$query_row['file_name']." in ".$query_row['folder']."</div>
            </div>";
        }
    }

    if($list=="") $list=$msg;
    $Send.=$list.$separator;

    //FILES
    $list="";
    $query="select file_name from files where file_name like '%".$x."%' and group_id='".$groupid."'";
    if(!$query_run=mysqli_query($con,$query)) die('Server Error');
    while($query_row=mysqli_fetch_assoc($query_run)){
        $list.="<li>".$query_row['file_name']."</li>";
    }

    if($list=="") $list=$msg;
    $Send.=$list.$separator;

    //FILE TYPE
    $list="";
    $query="select file_name from files where file_type like '%".$x."%' and group_id='".$groupid."'";
    if(!$query_run=mysqli_query($con,$query)) die('Server Error');
    while($query_row=mysqli_fetch_assoc($query_run)){
        $list.="<li>".$query_row['file_name']."</li>";
    }

    if($list=="") $list=$msg;
    $Send.=$list.$separator;

    //POSTS
    $list="";
    $query="select * from files where group_id='".$groupid."' and post like '%".$x."%'";
    if(!$query_run=mysqli_query($con,$query)) die('Server Error');
    while($query_row=mysqli_fetch_assoc($query_run)){
        $list.=" <div class=\"apost\">
        <h3 class=\"author\">".$allusers[$query_row['user_id']]."</h3>
        <div class=\"time\">".$query_row['timestamp']."</div>
        <div class=\"aposttext\">".$query_row['post']."</div>
        <div class=\"file-folder\">".$query_row['file_name']." in ".$query_row['folder']."</div>
        </div>";
    }

    if($list=="") $list=$msg;
    $Send.=$list.$separator;

    echo $Send;
}
else die('Error');
?>