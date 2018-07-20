<?php
ob_start();
session_start();
require('connect.inc.php');
if(!isset($_SESSION['user_id']) || !isset($_SESSION['group_id']) || empty($_SESSION['group_id']) || empty($_SESSION['user_id'])) header('Location: main_page.php');

include('invite.html');
?>