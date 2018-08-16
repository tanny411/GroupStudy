<?php
require('connect.inc.php');
require('core.inc.php');

if(!logged()) header('Location: main_page.php');
$user=getUser();
$to=$_GET['from'];

if(isset($_POST['oldpass']) &&!empty($_POST['oldpass']) && md5(mysqli_real_escape_string($con,$_POST['oldpass']))==$user[10])
{
    $pass=mysqli_real_escape_string($con,$_POST['pass']);
    $repeatpass=mysqli_real_escape_string($con,$_POST['repeatpass']);

    $fname=mysqli_real_escape_string($con,$_POST['fname']);
    $lname=mysqli_real_escape_string($con,$_POST['lname']);
    $pnum=mysqli_real_escape_string($con,$_POST['pnum']);
    $dob=mysqli_real_escape_string($con,$_POST['dob']);
    $inst=mysqli_real_escape_string($con,$_POST['inst']);
    $country=mysqli_real_escape_string($con,$_POST['country']);
    $gender=mysqli_real_escape_string($con,$_POST['gender']);
    $aboutme=mysqli_real_escape_string($con,$_POST['aboutme']);
    $fb=mysqli_real_escape_string($con,$_POST['facebook']);
    $linkedin=mysqli_real_escape_string($con,$_POST['linkedin']);
    $git=mysqli_real_escape_string($con,$_POST['github']);

    $ok=false;

    if(!empty($pass)){
    if(!empty($repeatpass) && $pass==$repeatpass) {$ok=true;$pass=md5($pass);}
        else {
            $msg="<strong style=\"color:red\";>Passwords don't match</strong>";
        }
    }
    else {$ok=true; $pass=$user[10];}
    
    if($ok==true){
        if(empty($fname)) $fname=$user[2];
        if(empty($lname)) $lname=$user[3];
        if(empty($pnum)) $pnum=$user[5];
        if(empty($dob)) $dob=$user[6];
        if(empty($inst)) $inst=$user[8];
        if(empty($country)) $country=$user[9];
        if(empty($gender)) $gender=$user[7];

        if(empty($aboutme)) $aboutme=$user[12];
        if(empty($fb)) $fb=$user[13];
        if(empty($linkedin)) $linkedin=$user[14];
        if(empty($git)) $git=$user[15];
        
        $pp="defaultpp.jpg";
        ///make image smaller before saving
        if (isset($_FILES['pp']) && !empty($_FILES['pp']) && !empty($_FILES['pp']['name'])){
            $pp= basename($_FILES['pp']['name']);
            $target_file = "C:/xampp/htdocs/GroupProject/pp/" . $pp;
            $ext=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $pp=$user[1].'.'.$ext;
            $target_file = "C:/xampp/htdocs/GroupProject/pp/" . $pp;
            if( is_uploaded_file($_FILES['pp']['tmp_name']) && $_FILES['pp']['error'] == UPLOAD_ERR_OK && move_uploaded_file($_FILES["pp"]["tmp_name"], $target_file)) ;
            else $pp="defaultpp.jpg";
        }

        $query="update user set Firstname='$fname',Lastname='$lname',PhoneNumber='$pnum',DOB='$dob',Gender='$gender',Institution='$inst',Country='$country',Password='$pass',pic='$pp',Aboutme='$aboutme',facebook='$fb',linkedin='$linkedin',github='$git' where ID=".$user[0];
        if(!$query_run=mysqli_query($con,$query)) $msg="<strong style=\"color:red\";>There was a problem. Please try again.</strong>"; 
        else header('Location: '.$to);
    }
}
else $msg="Current Password must match!";

include('profile_setting_form.php');
?>