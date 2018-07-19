<!DOCTYPE html>
<html>
	<head>
		<title>GroupStudy</title>
		<link rel="stylesheet" type="text/css" href="profile_setting.css"/>
		<script type="text/javascript" src="mainjs.js"></script>
	</head>
	<body>
		<img class="backimg" src="backSetting.jpg"/>
		<div class="title">Settings</div>
		<div class="back">
		<div class="error"><?php  echo $msg; ?></div>
		<hr>
		<form action="#" method="POST" enctype="multipart/form-data">

			<div>Username: <input type="text" name="name" value="<?php echo $user[1] ?>" readonly></div>
			
			<div>Email: <input type="email" name="email" value="<?php echo $user[4] ?>" readonly/></div>
			
			<div>Change Password: <input type="password" name="pass" placeholder="Enter New Password" title="Password should be minimum 6 characters long"/></div>
			<div>Confirm New Password: <input type="password" name="repeatpass" placeholder="Confirm New Password"/></div>
			<div>*Confirm Old Password: <input type="password" name="oldpass" placeholder="Confirm Old Password"/></div>
			<div>First name: <input type="text" name="fname" maxlength="30" value="<?php echo $user[2] ?>" /></div>
			<div>Last name: <input type="text" name="lname"  maxlength="30" value="<?php echo $user[3] ?>"/></div>
			<div>About Me: <input type="text" name="aboutme"  maxlength="1000" value="<?php echo $user[12] ?>"/></div>
			
			<div>Facebook: <input type="text" name="facebook"  maxlength="1000" value="<?php echo $user[13] ?>"/></div>
			<div>LinkedIn: <input type="text" name="linkedin"  maxlength="1000" value="<?php echo $user[14] ?>"/></div>
			<div>Github: <input type="text" name="github"  maxlength="1000" value="<?php echo $user[15] ?>"/></div>

			<div>Phone Number: <input type="number" name="pnum"  value="<?php echo $user[5] ?>"/></div>
			
			<div>Date Of Birth: <input type="date" name="dob"  value="<?php echo $user[6] ?>"/></div>
			
			<div>Gender:
			
				<div class="male">Male</div>
				<input type="radio" name="gender" value="male" <?php echo($user[7]=='male'?'checked="checked"':''); ?> />
				<div class="female">Female</div>
				<input type="radio" name="gender" value="female" <?php echo($user[7]=='female'?'checked="checked"':''); ?> />
				<div class="other">Other</div>
				<input type="radio" name="gender" value="other" <?php echo($user[7]=='other'?'checked="checked"':''); ?> />
			
			</div>
			
			<div>Institution: <input type="text" name="inst"  maxlength="100" value="<?php echo $user[8] ?>"/></div>
			
			<div>Country: <input type="text" name="country"  maxlength="20" value="<?php echo $user[9] ?>"/></div>
			<div><img src=<?php echo 'pp/'.$user[11]; ?> class="pp"/></div>
			<div>Profile Picture: <input type="file" accept="image/*" name="pp"/> </div>

			<div>
				<input type="button" name="cancel" onclick="redirect('<?php echo $to; ?>')" value="Cancel"/>
				<input type="submit" name="save" value="Save"/>
			</div>
			<br/><br/>
		</form>
		</div>
	</body>
</html>