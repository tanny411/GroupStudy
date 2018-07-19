<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GroupStudy</title>
<link href='http://fonts.googleapis.com/css?family=Englebert|Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
<link href="profile.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body>
<div id="header" class="container">
	<div id="logo">
		<h1 class="huu"><a href="#"><?php echo $user[2]." ".$user[3];?></a></h1>
	</div>
</div>
<div id="wrapper" class="container">
	<div id="page">
		<div id="content"> <a href="#" class="image-style"><img src="pp/<?php echo $user[11];?>" width="auto" height="250" alt="" /></a>
			<h2>About <?php echo $user[2]." ".$user[3]." ( ".$user[1]." )";?> :</h2>
            <p><?php echo $user[12];?></p>
        </div>
		<div id="sidebar">
			<div id="sbox1">
				<h2>Info :</h2>
				<ul class="list-style1">
					<li class="first">
						<h3>Phone Number</h3>
						<p><?php echo $user[5];?></p>
					</li>
					<li>
						<h3>Date of birth</h3>
						<p><?php echo $user[6];?></p>
					</li>
					<li>
						<h3>Gender</h3>
						<p><?php echo $user[7];?></p>
                    </li>
                    <li>
						<h3>Institution</h3>
						<p><?php echo $user[8];?></p>
                    </li>
                    <li>
						<h3>Country</h3>
						<p><?php echo $user[9];?></p>
					</li>
				</ul>
			</div>
			<div id="sbox2">
				<h2>Contact Information</h2>
					<ul class="list-style2">
                        <li><a href="">Email : <?php echo $user[4];?></a></li>
						<li class="first"><a href="<?php echo $user[13];?>">Facebook profile : <?php echo $user[13];?></a></li>
						<li><a href="<?php echo $user[14];?>">LinkedIn profile : <?php echo $user[14];?></a></li>
						<li><a href="<?php echo $user[15];?>">GitHub : <?php echo $user[15];?></a></li>
					</ul>
			</div>
		</div>
	</div>
</div>
<div id="footer">
	<p>Copyright (c) 2018 GroupStudy. All rights reserved.</p>
</div>
</body>
</html>
