<?php
	$user=getUser();
	
	$msg="Fill these out and click OK to create a new group";
	
	if(isset($_POST['grp_name']) && isset($_POST['grp_desc']) && isset($_POST['time']) && isset($_POST['users']) && isset($_POST['emails']) && isset($_POST['pass']))
	{
		$name=mysqli_real_escape_string($con,$_POST['grp_name']);
		$desc=mysqli_real_escape_string($con,$_POST['grp_desc']);
		$time=$_POST['time'];
		$users=mysqli_real_escape_string($con,$_POST['users']);
		$pass=mysqli_real_escape_string($con,$_POST['pass']);
		$emails=$_POST['emails'];
		
		if(!empty($name) && !empty($desc) && !empty($time))
		{
			$query="select name from groups where name='".$name."'";
			if($query_run=mysqli_query($con,$query)){
			$rows=mysqli_num_rows($query_run);
			if($rows>0) $msg="<strong style=\"color:red\";>Such Group Exists</strong>";
			else
			{
				//php to php POST request
				$params = array ('username' => 'tanny411', 'password' => 'aysha','meetingtitle' => $name,'meetingpassword' => $pass);

				$query = http_build_query ($params);

				$contextData['method']='POST';
				$contextData['content']=$query;
				$contextData['header']="Content-Type: application/x-www-form-urlencoded\r\n"."Connection: close\r\n"."Content-Length: ".strlen($query)."\r\n";
				
				$context = stream_context_create (array ( 'http' => $contextData ));

				$boardId =  file_get_contents ('https://www.twiddla.com/API/CreateMeeting.aspx',false,$context);

				$query="insert into groups values('','".$name."','".$desc."','".$time."' , '".$boardId."','".$pass."')";
				if($query_run=mysqli_query($con,$query)){
				
					//setting session, and putting user-group relations
					$query="select id from groups where name='".$name."'";
					if($query_run=mysqli_query($con,$query)){
						mysqli_data_seek($query_run,0);
						$row=mysqli_fetch_row($query_run);
						$id=$row[0];
						$query="insert into user_group values ('".$user[0]."','".$id."',0)";
						$query_run=mysqli_query($con,$query);

						//inviting others
							//direct invitation my DIRECT messages NOT DONE
						$users_ara=explode(',',$users);
						//foreach($users_ara as $ele) echo $ele.'<br/>';

						//mailing users
							//Verfication on entering NOT DONE
						$subject="Invitation from GroupStudy";
						$body='Hello, Greetings from GroupStudy.'."\n\n".'You have been invited to join the group '.$name.' by '.$user[1].'('.$user[4].'). Join the group and start collaborating. Register today if you haven\'t already.'."\n\n".'From GroupStudy.';
						$header="From: GroupStudy <keuna@tanny.com>".PHP_EOL ."Reply-To: aysha.kamal7@gmail.com".PHP_EOL;
						//from doest work, (fix it) ; reply to works

						$emails=$emails.',';
						$emails_ara=explode(",",$emails,-1);
						foreach($emails_ara as $ele) mail($ele,$subject,$body,$header);
						
						header('Location: setsession.php?id='.$id);
					}
				}
			}
			}
		}
		else $msg="<strong style=\"color:red;\">Please fill in all the fields(Invitations can be skipped)</strong>";
	}
	include('loggedin_form.php');
?>