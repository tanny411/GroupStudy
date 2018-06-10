<?php
    
    require('connect.inc.php');
    ob_start();
    session_start();

    $folder = strtolower(mysqli_real_escape_string($con,trim($_POST['folder'])));
    $parent = strtolower(mysqli_real_escape_string($con,trim($_POST['parent'])));
    $groupid = mysqli_real_escape_string($con,$_POST['groupid']);

    $query="select * from folder where group_id = ".$groupid." and folder='".$folder."'";
    if(!$query_run=mysqli_query($con,$query)) die('Server error');
    $rows=mysqli_num_rows($query_run);
    if($rows>0) die('<strong>Folder exists</strong>');

    $query="insert into folder values ( '".$groupid."','".$folder."','".$parent."' )";
    if(!$query_run=mysqli_query($con,$query)) die('Server error');

    echo '<strong>Folder Added</strong>'
?>