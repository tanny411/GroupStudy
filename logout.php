<?php
ob_start();
session_start();
session_destroy();
header('location: /groupstudy/groupproject/main_page.php');
?>