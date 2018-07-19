<html>
	<head>
		<title>GroupStudy</title>
		<link rel="stylesheet" type="text/css" href="login.css"/>
	</head>
	<body>
	<img src="backL.jpg"/>
	<div class="back">
		<div class="error"><?php echo $msg; ?></div>
		<form action="<?php $current_file; ?>" method="POST">
			Username: <input type="text" name="name"/><br/><br/>
			Password: <input type="password" name="pass"/>
			<input type="submit" name="submit" value="Log In"/><br/><br/>
		</form>
		<div class="register">Not a member already? <a href="register.php">Register</a></div>
	</div>
	</body>

</html>