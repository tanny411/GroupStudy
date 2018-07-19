<head>
	<title>GroupStudy</title>
	<link rel="stylesheet" type="text/css" href="register.css"/>
	<script type="text/javascript" src="mainjs.js"></script>
</head>
<body>
	<img class="backimg" src="backR.jpg"/>
	<div class="title">Register</div>
	<div class="back">
	<div class="error"><?php  echo $msg; ?></div>
	<hr>
	<form action="register.php" method="POST" enctype="multipart/form-data">

		<div class="a">*Username: <input type="text" name="name" placeholder="Display name" maxlength="30"/></div>
		
		<div class="b">*Email: <input type="email" name="email" placeholder="Valid Email Address" title="Please enter a valid email address to ensure account activation"/></div>
		
		<div class="c">*Password: <input type="password" name="pass" placeholder="Enter Password" title="Password should be minimum 6 characters long"/></div>
		<div class="d">*Confirm Password: <input type="password" name="repeatpass" placeholder="Confirm Password"/></div>
		<div class="e">*First name: <input type="text" name="fname" maxlength="30" value="<?php if(isset($fname))echo $fname;?>" /></div>
		<div class="f">*Last name: <input type="text" name="lname"  maxlength="30" value="<?php if(isset($lname))echo $lname;?>"/></div>
		
		<div class="g">Phone Number: <input type="number" name="pnum"  value="<?php if(isset($pnum))echo $pnum;?>"/></div>
		
		<div class="h">Date Of Birth: <input type="date" name="dob"  value="<?php if(isset($dob))echo $dob;?>"/></div>
		
		<div class="i">Gender:
		
			<div class="male">Male</div>
			<input type="radio" name="gender" value="male"/>
			<div class="female">Female</div>
			<input type="radio" name="gender" value="female"/>
			<div class="other">Other</div>
			<input type="radio" name="gender" value="other" checked="checked"/>
		
		</div>
		
		<div class="j">Institution: <input type="text" name="inst"  maxlength="100" value="<?php if(isset($inst))echo $inst;?>"/></div>
		
		<div class="k">Country: <input type="text" name="country"  maxlength="20" value="<?php if(isset($country))echo $country;?>"/></div>
		
		<div>Profile Picture: <input type="file" accept="image/*" name="pp"/> </div>

		<div class="l"><img src="generatecaptcha.php"><br/>
		<br/>Type the text of the image: <input type="text" name="captcha"/></div>
		
		<div class="m">By creating an account you agree to our <a href="#">Terms & Privacy</a>.</div>
		
		<div class="n">
		
		<input type="button" onclick="redirect('main_page.php');" name="cancel" value="Cancel"/>
		
		<input type="submit" name="register" value="Register"/></div>
		<br/><br/>
	</form>
	</div>
</body>