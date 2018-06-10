<?php
    
    require('connect.inc.php');
    ob_start();
    session_start();

    $folder = strtolower(mysqli_real_escape_string($con,trim($_POST['folder'])));
    $parent = strtolower(mysqli_real_escape_string($con,trim($_POST['parent'])));
    $groupid = mysqli_real_escape_string($con,$_POST['groupid']);

    $query="delete from folder where group_id = ".$groupid." and folder='".$folder."' and parent='".$parent."'";
    if(!$query_run=mysqli_query($con,$query)) die('<strong>Could not delete. Server error</strong>');

    echo '<strong>Folder Deleted</strong>'
?>