<?php

	$msg="";
	if(isset($_POST['name']) && isset($_POST['pass']) && isset($_POST['submit']))
	{
		$name=htmlentities($_POST['name']);
		$pass=htmlentities($_POST['pass']);
		$submit=htmlentities($_POST['submit']);
		
		if(!empty($name)&&!empty($pass)&&!empty($submit))
		{
			$query="select ID from user where username='".mysqli_real_escape_string($con,$name)."' and password='".mysqli_real_escape_string($con,md5($pass))."'";
			if($query_run=mysqli_query($con,$query))
			{
				$num=mysqli_num_rows($query_run);
				if($num!=1)
				{
					$msg='Invalid Username or Password';
				}
				else
				{
					mysqli_data_seek($query_run,0);
					$row=mysqli_fetch_row($query_run);
					$id=$row[0];
					$_SESSION['user_id']=$id;
					header('Location: '.$current_file);
				}
			}
			else $msg='Error Logging In';
		}
		else  
		{
			$msg='Please fill in all fields';
		}
	}
	include ('login_form.php');
?>
