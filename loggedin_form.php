<html>
	<head>
		<script type="text/javascript" src="loggedin.js"></script>
		<link rel="stylesheet" type="text/css" href="loggedin.css"/>
	</head>
	<body>
		<header>
			<div class="headerback"></div>
			<div class="welcome">
				Welcome,
			</div>
			<div class="pic">
				<img src=<?php echo 'pp/'.$user[11]; ?> class="pp"/>
				<div class="name">
					<?php echo "$user[2] $user[3] ( $user[1] )"; ?>
				</div>
			</div>
		</header>
		<a href="profile_setting.php?from=main_page.php" class="top-btn setting">Settings</a>
		<a href="logout.php" class="top-btn logout">Logout</a>
		<div class="btn">
			<div class="a"><input type="button" onclick="oldgroup();" class="oldgroup" value="Enter existing group"/></div>
			<div class="b">
			
				<div class="old">
					<div class="oldtop">
						Choose a group to enter.
						<div class="search">
						<img src="search_img.png" class="searchimg"/>
						<input type="text" onkeyup="load('grplist','group_list.php',searchgrp);" name="searchgrp" class="searchgrp" id="searchgrp" placeholder="search for your group"/>
						</div>
						<hr class="oldhr"/>
					</div>
					<ul class="grplist" id="grplist">
					<script>load('grplist','group_list.php',searchgrp);</script>
					</ul>
				</div>
				
				<div class="new">
					
					<div class="newtop"><?php echo $msg; ?><hr/></div>
					
					<form action="<?php echo $current_file; ?>" method="POST" class="newform">
					
					<div class="grpname newtxt"> Group Name: <input type="text" name='grp_name' class="newinp" placeholder="Name your group"/> </div>
					<div class="about newtxt">Group Description:<textarea name="grp_desc" placeholder="Tell us what your group is about" class="newinp newtextarea"><?php if(isset($desc) && !empty($desc)) echo $desc; ?></textarea> </div>
					<div class="boardpass newtxt"> Board Password: <input type="password" name='pass' class="newinp" placeholder="Share ONLY with group members"/> </div>
					<div class="time newtxt">Group Expiration:
						<select name="time" class="newinp newselect">
							<option value="1">1 Month</option>
							<option value="2">2 Months</option>
							<option value="3">3 Months</option>
							<option value="4">4 Months</option>
							<option value="5">5 Months</option>
							<option value="6">6 Months</option>
							<option value="7">7 Months</option>
							<option value="8">8 Months</option>
							<option value="9">9 Months</option>
							<option value="10">10 Months</option>
							<option value="11">11 Months</option>
							<option value="12">12 Months</option>
						</select>
					</div>
					<div class="invite newtxt">Invite users:<input type="text" name="users" placeholder="Type names separated by comma" class="newinp"  value="<?php if(isset($users) && !empty($users)) echo $users; ?>"/></div>
					<div class="mail newtxt">Invite by email:<input type="text" name="emails" placeholder="Valid comma separated Emails" class="newinp"  value="<?php if(isset($emails) && !empty($emails)) echo $emails; ?>"/></div>
					
					<input type="submit" name="newok" class="newok" value="OK"/>
					</form>
					
				</div>
				
				<script>
					isit="<?php if(isset($_POST['newok']) && !empty($_POST['newok'])) echo 1; else echo 0; ?>";
					if(isit==1) newgroup();
				</script>
				
			</div>
			<div class="c"><input type="button" onclick="newgroup();" class="newgroup" value="Create new Group"/></div>
			
		</div>
	</body>
</html>