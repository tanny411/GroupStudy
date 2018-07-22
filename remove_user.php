<?php
    include('core.inc.php');
    include('connect.inc.php');
    if(isset($_POST['pass']) && !empty($_POST['pass']) && isset($_SESSION['user_id']) && !empty($_SESSION['user_id']) && isset($_SESSION['group_id']) && !empty($_SESSION['group_id'])){
        $groupid=$_SESSION['group_id'];
        $userid=$_SESSION['user_id'];
        $pass=$_POST['pass'];
        $query="select pass from groups where id='".$groupid."'";
		if($query_run=mysqli_query($con,$query)){
            $query_row=mysqli_fetch_assoc($query_run);
            if($pass==$query_row['pass']){

                $query="delete from user_group where group_id='".$groupid."' and user_id='".$userid."'";
		        if(!$query_run=mysqli_query($con,$query)) die('Server Error');
                $query="delete from notifs where group_id='".$groupid."' and user_id='".$userid."'";
                if(!$query_run=mysqli_query($con,$query)) die('Server Error');
                
                echo 0;
            }
            else echo "Wrong Password! Sorry you're not removed.";
        } else echo "Server Error!";
    }
    else echo "Oopss!! Somethings Wrong!";
?>