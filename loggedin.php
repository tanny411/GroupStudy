<?php
	$user=getUser();
	
	$msg="Fill these out and click OK to create a new group";
	
	if(isset($_POST['grp_name']) && isset($_POST['grp_desc']) && isset($_POST['time']) && isset($_POST['emails']) && isset($_POST['pass']))
	{
		$name=mysqli_real_escape_string($con,$_POST['grp_name']);
		$desc=mysqli_real_escape_string($con,$_POST['grp_desc']);
		$time=$_POST['time'];
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
				$boardpass = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789',5)),1,6);
				$params = array ('username' => 'tanny411', 'password' => 'aysha','meetingtitle' => $name,'meetingpassword' => $boardpass);

				$query = http_build_query ($params);

				$contextData['method']='POST';
				$contextData['content']=$query;
				$contextData['header']="Content-Type: application/x-www-form-urlencoded\r\n"."Connection: close\r\n"."Content-Length: ".strlen($query)."\r\n";
				
				$context = stream_context_create (array ( 'http' => $contextData ));

				$boardId =  file_get_contents ('https://www.twiddla.com/API/CreateMeeting.aspx',false,$context);
				
				$query="insert into groups values('','".$name."','".$desc."','".$time."' , '".$boardId."','".$pass."','".$boardpass."')";
				if($query_run=mysqli_query($con,$query)){
				
					//setting session, and putting user-group relations
					$query="select id from groups where name='".$name."'";
					if($query_run=mysqli_query($con,$query)){
						mysqli_data_seek($query_run,0);
						$row=mysqli_fetch_row($query_run);
						$id=$row[0];
						$query="insert into user_group values ('".$user[0]."','".$id."',0)";
						$query_run=mysqli_query($con,$query);

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
	//INVITATIONS
	$notif_num="";
	$query="select id,group_id,msg from invites where username='".$user[1]."'";
	if($query_run=mysqli_query($con,$query)){
		$notif_num=mysqli_num_rows($query_run);
		$notif_str="";
		while($query_row=mysqli_fetch_assoc($query_run)){
			$id=$query_row['id'];
			$grpid=$query_row['group_id'];
			$msg=$query_row['msg'];
			$query="select name,description from groups where id='".$grpid."'";
			$query_run2=mysqli_query($con,$query);
			$query_row2=mysqli_fetch_assoc($query_run2);
			$des=$query_row2['description'];
			$name=$query_row2['name'];
			///html
			$notif_str.="<li>
			<div class=\"notif-text\"># You have been invited to join the group <i><b>\"".$name."\"</b></i><br/>
			<b>GroupInfo</b>: ".$des."<br/><b>Message</b>: ".$msg."</div>
			<button id=\"ac\">Accept</button>
			<button id=\"wa\">Decline</button>
			<div id=\"inviteid\" style=\"display:none;\">".$id."</div>
			<div id=\"grpid\" style=\"display:none;\">".$grpid."</div>
			</li>";
		}
	}
	include('loggedin_form.php');
?>