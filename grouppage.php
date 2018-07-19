<?php
	include('core.inc.php');
	include('connect.inc.php');
	
	$user=getUser();
	if(isset($_SESSION['group_id']) && !empty($_SESSION['group_id'])) $group_id=$_SESSION['group_id'];
	else header('location: /groupstudy/groupproject/main_page.php');

	//setting as online
	$query="update user_group set offline='0' where user_id='".$_SESSION['user_id']."' and group_id='".$_SESSION['group_id']."'";
	if(!$query_run=mysqli_query($con,$query)) die('Database Error, sorry could not connect');
	
	//GROUP-INFOS
	$query="select * from groups where id='".$group_id."'";
	if($query_run=mysqli_query($con,$query)){
		mysqli_data_seek($query_run,0);
		$row=mysqli_fetch_row($query_run);
		$group_name=$row[1];
		$board_id=$row[4];
		$board_pass=$row[5];
	}
	else die('Server Error');

	//assoc of all-users id and name
	$allusers[$user[0]]=$user[1];
	$html_list=""; //not in use
	//USER-LIST-CHAT
	$userList="";
	$query="select user_id from user_group where group_id='".$group_id."'";
	if($query_run=mysqli_query($con,$query)){
		while($query_row=mysqli_fetch_assoc($query_run)){
			$id=$query_row['user_id'];
			if($id==$user[0]) continue;
			$query="select Username from user where ID='".$id."'";
			if($query_run2=mysqli_query($con,$query)){
				mysqli_data_seek($query_run2,0);
				$row=mysqli_fetch_row($query_run2);
				$name=$row[0];
				$userList=$userList."<li id=\"user_".$id."\"><a href=\"profile.php?user=".$name."\">".$name."</a><div class=\"status\"></div></li>";
				//assoc save
				$allusers[$id]=$name;
				$html_list.="<input type=\"hidden\" name=\"allusers[".$id."]\" value=\"".$name."\">";  //not in use
			}
			else die('Server Error');
		}
	}
	else die('Server Error');


	//FEED and FILE
	$feed="";
	$fileList="";
	//file-folder & folder-folder assoc
	$filein=array();
	$folderin=array();

	$query="select * from files where group_id='".$group_id."' order by timestamp desc";
	if($query_run=mysqli_query($con,$query)){
		while($query_row=mysqli_fetch_assoc($query_run)){
			
			$comments="";

			$query="select * from comments where file_id='".$query_row['id']."' order by timestamp desc";
			if($query_run2=mysqli_query($con,$query)){
				while($query_row2=mysqli_fetch_assoc($query_run2)){
					
					$query_row2['comment']=nl2br($query_row2['comment']);
					$comments.="<div class=\"comment-box\" id=\"com_".$query_row2['id']."\">";
					if($user[0]==$query_row2['user_id']) $comments.="<div class=\"com-cross\">X</div>";
					$comments.="<h4 class=\"author\">".$allusers[$query_row2['user_id']]."</h4><div class=\"time\">".$query_row2['timestamp']."</div>".$query_row2['comment']."</div>";
				}
			} else die('Server Error');

			$query_row['post']=nl2br($query_row['post']);

			$feed.="<span class=\"anchor\" id=\"jump_".$query_row['id']."\"></span><div class=\"apost\" id='".$query_row['id']."'>";
			if($user[0]==$query_row['user_id'])$feed.="<div class=\"cross\">X</div>";
			$feed.="<h3 class=\"author\">".$allusers[$query_row['user_id']]."</h3>
			<div class=\"time\">".$query_row['timestamp']."</div>
			<div class=\"aposttext\">".$query_row['post']."</div>
			<div class=\"commentbtn\">comment</div>
			<div class=\"file-folder\">".$query_row['file_name']." in ".$query_row['folder']."</div>";
			$feed.="<div class=\"comment-list\">
			<div class=\"comment-box curr\"><textarea class=\"com-text\"></textarea><button class=\"com-postbtn\">post</button></div>
			<div class=\"comments\">".$comments."</div></div></div>";

			if($query_row['file_name']!="") {
				$fileList.="<li><i class=\"fa fa-file-o\"></i> ".$query_row['file_name']."</li>";
				$filein[ $query_row['folder'] ][]=$query_row['file_name'];
			}
		}
	}
	else die('Server Error');


	///FOLDER
	$query="select folder,parent from folder where group_id='".$group_id."'";
	if($query_run=mysqli_query($con,$query)){
		while($query_row=mysqli_fetch_assoc($query_run)){
			$folderin[ $query_row['parent'] ][]=$query_row['folder'];
		}
	}

	$str="<li class=\"dropdown-submenu\"><a class=\"clk\"><i class=\"fa fa-folder\"></i> root</a><i class=\"fa fa-plus addfolder r8\"></i>";
	//$str="";
	function dfs($folder)
	{
		global $str;
		global $filein;
		global $folderin;
				
		$temp="<ul>";

		if (array_key_exists($folder, $filein)) {
			foreach($filein[$folder] as $file){
				$temp.="<li><i class=\"fa fa-file-o\"></i> ".$file."</li>";
			}
		}
		if (array_key_exists($folder, $folderin))  {
			foreach($folderin[$folder] as $fol){
				$temp.="<li class=\"dropdown-submenu\"><a class=\"clk\"><i class=\"fa fa-folder\"></i> ".$fol."</a><i class=\"fa fa-plus addfolder r8\"></i>";
				$x=dfs($fol);
				if($x=="<ul></ul>") $temp.="<i class=\"fa fa-minus removefolder r8\"></i>";
				$temp.=$x."</li>";
			}
		}

		$temp.="</ul>";
		return $temp;
	}

	$str.=dfs("root")."</li>";

	$link="https://www.twiddla.com/api/start.aspx?sessionid=".$board_id."&guestname=".$user[1]."&password=".$board_pass."&hide=invite,profile,url,welcome";

	//NOTIFICATIONS
	$notif_num="100";
	$query="select id,type,file_id,com_no from notifs where group_id='".$group_id."' and user_id='".$user[0]."'";
	if($query_run=mysqli_query($con,$query)){
		$notif_num=mysqli_num_rows($query_run);
		$notif_str="";
		while($query_row=mysqli_fetch_assoc($query_run)){
			///sentence based on notif type
			if($query_row['type']=="post") $str_temp="# New post from <b></b>.";
			if($query_row['type']=="comment") $str_temp="# ".$query_row['com_no']." New comment(s) on <b>Your</b> post.";
			if($query_row['type']=="follow") $str_temp="# ".$query_row['com_no']." New comment(s) on <b></b>'s post.";
			///html
			$notif_str.="<li><div class=\"notif-del\">x</div><a href=\"#jump_".$query_row['file_id']."\" class=\"see-notif\"><div class=\"notif-head\">".$str_temp."</div><div class=\"notif-text\">".$query_row['file_id']."</div></a><div class=\"notif-type hide\">".$query_row['type']."</div><div class=\"notif-id hide\">".$query_row['id']."</div></li>";
		}
	}

	include('grouppage.html');
?>