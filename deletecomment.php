<?php
require('connect.inc.php');
ob_start();
session_start();

if(isset($_POST['id']) && !empty($_POST['id'])){
    
    $id=$_POST['id'];
    $query="delete from comments where id='".$id."'";
    if(!mysqli_query($con,$query)) die('Server Error');
    echo 'Deleted<br/>';
}
else die('Error');

?>