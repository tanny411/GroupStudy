<?php
require('connect.inc.php');
require('core.inc.php');

if(!logged() || !isset($_GET['user']) || empty($_GET['user']) ) header('Location: main_page.php');
$user=getsomeUser($_GET['user']);

include('profile_form.php')
?>