<?php
ob_start();
session_start();
session_destroy();
header('location: /groupproject/main_page.php');
?>