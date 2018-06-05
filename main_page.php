<?php

	require('connect.inc.php');
	require('core.inc.php');
	if(logged()) include('loggedin.php');
	else include ('login.php');
?>