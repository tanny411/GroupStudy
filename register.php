<?php

	require('connect.inc.php');
	require('core.inc.php');
	if(logged()) echo "You're already registered and logged in.";
	else 
	{
		$msg="Fields with * are mandatory";
		
		@$prevrand=$_SESSION['secure'];
		$rand=substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),1,6);
		$_SESSION['secure']=$rand;
		
		if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['pass'])&& isset($_POST['repeatpass']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['captcha']))
		{
			$captcha=$_POST['captcha'];
			if($prevrand!=$captcha) 
			{
				$msg="<strong style=\"color:red\";>Captcha did not match!</strong>";
			}
			else
			{
				$name=mysqli_real_escape_string($con,$_POST['name']);
				$email=mysqli_real_escape_string($con,$_POST['email']);
				$pass=mysqli_real_escape_string($con,$_POST['pass']);
				$repeatpass=mysqli_real_escape_string($con,$_POST['repeatpass']);
				$fname=mysqli_real_escape_string($con,$_POST['fname']);
				$lname=mysqli_real_escape_string($con,$_POST['lname']);
				$pnum=mysqli_real_escape_string($con,$_POST['pnum']);
				$dob=mysqli_real_escape_string($con,$_POST['dob']);
				$inst=mysqli_real_escape_string($con,$_POST['inst']);
				$country=mysqli_real_escape_string($con,$_POST['country']);
				$gender=mysqli_real_escape_string($con,$_POST['gender']);
				
				if(!empty($name) && !empty($email) && !empty($pass)&& !empty($repeatpass) && !empty($fname) && !empty($lname))
				{
					if($pass!=$repeatpass) $msg="<strong style=\"color:red\";>Passwords don't match</strong>";
					else
					{
						$query="select Username from user where Username='".$name."'";
						if(!$query_run=mysqli_query($con,$query)) $msg="<strong style=\"color:red\";>There was a problem. Please try again.</strong>";
						$rows=mysqli_num_rows($query_run);
						if($rows>0) $msg="<strong style=\"color:red\";>Username Exists</strong>";
						else
						{
							//mailing user
							$subject="Welcome to GroupStudy";
							$body="Hello, ".$fname.' '.$lname.'.'."\n\n".'Welcome to GroupStudy. Thank you for registering with us.'."\n\n".'Your username:'.$name."\n".'Your password:'.$pass;
							$header="From: GroupStudy <keuna@tanny.com>".PHP_EOL ."Reply-To: aysha.kamal7@gmail.com".PHP_EOL;
							//from doest work, (fix it) ; reply to works
							if(mail($email,$subject,$body,$header)) {

								$pp="defaultpp.jpg";

								///make image smaller before saving
								if (isset($_FILES['pp']) && !empty($_FILES['pp']) && !empty($_FILES['pp']['name'])){
									$pp= basename($_FILES['pp']['name']);
									$target_file = "C:/xampp/htdocs/GroupStudy/GroupProject/pp/" . $pp;
									$ext=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
									$pp=$name.'.'.$ext;
									$target_file = "C:/xampp/htdocs/GroupStudy/GroupProject/pp/" . $pp;
									if( is_uploaded_file($_FILES['pp']['tmp_name']) && $_FILES['pp']['error'] == UPLOAD_ERR_OK && move_uploaded_file($_FILES["pp"]["tmp_name"], $target_file)) ;
									else $pp="defaultpp.jpg";
								}

								$pass=md5($pass);
								$query="insert into user values('','$name','$fname','$lname','$email','$pnum','$dob','$gender','$inst','$country','$pass','$pp')";
								if(!$query_run=mysqli_query($con,$query)) $msg="<strong style=\"color:red\";>There was a problem. Please try again.</strong>"; 
								else header('Location: registered.html');
							}
							else $msg = '<strong style=\"color:red\";>Email Sending Failed<strong/>';
						}
					}
				}
				else $msg="<strong style=\"color:red;\">Please make sure all the fields marked with an * are filled in properly</strong>";
			}
		}
		include('register_form.php');
	}
	
?>