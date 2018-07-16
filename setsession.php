<?php
    include('core.inc.php');
    include('connect.inc.php');
    $_SESSION['group_id']=$_GET['id'];
    header('Location: grouppage.php');
?>