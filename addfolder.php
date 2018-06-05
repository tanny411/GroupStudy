<?php
    
    require('connect.inc.php');
    ob_start();
    session_start();

    $folder = mysqli_real_escape_string($con,trim($_POST['folder']));
    $parent = mysqli_real_escape_string($con,trim($_POST['parent']));
    $groupid = mysqli_real_escape_string($con,$_POST['groupid']);

    $query="insert into folder values ( '".$groupid."','".$folder."','".$parent."' )";
    if(!$query_run=mysqli_query($con,$query)) die('Server error');
?>