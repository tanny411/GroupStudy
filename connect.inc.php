<?php

@$con=mysqli_connect('localhost','root','') or die('Could not connect');
@mysqli_select_db($con,'GroupStudy') or die('database error');

?>