<?php
require('connect.inc.php');
ob_start();
session_start();
//echo $_SERVER['DOCUMENT_ROOT'];
if(isset($_POST['task']) && $_POST['task']=='addpost' )
{
    $msg="<strong style=\"color:red\";>Sorry there was a problem. Your post was not uploaded. Please try again later.</strong><br/>";

    $post="";
    $tags="";
    $tofolder="root";
    $file="";
    $ext="";
    $userid=$_POST['userid'];
    $groupid=$_POST['groupid'];
    $username=$_POST['username'];

    $ok="NOP";
    $filease=true;

    if(isset($_POST['posttext']) && !empty($_POST['posttext']))  $post= $_POST['posttext'];
    if(isset($_POST['tagtext']) && !empty($_POST['tagtext']))  $tags= $_POST['tagtext'];
    if(isset($_POST['folder']) && !empty($_POST['folder']))  $tofolder= $_POST['folder'];

    if (isset($_FILES['file']) && !empty($_FILES['file']) && !empty($_FILES['file']['name']))
    {
        $file= $_FILES['file']['name'];
        $target_file = "C:/xampp/htdocs/GroupStudy/GroupProject/files/" .$groupid.'_'. basename($file);
        $ext=strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        //echo $file;
        if ($file!="" && file_exists($target_file)) {
            echo "<strong style=\"color:red\";>Sorry, the file already exists.</strong><br/>";
            $ok="umm";
        }
        else if ($_FILES["file"]["size"] > 500000) {
            echo "<strong style=\"color:red\";>Sorry, the file is too large.</strong><br/>";
            $ok="umm";
        }
        else if(is_uploaded_file($_FILES['file']['tmp_name']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) 
            {
                $ok="OK";
            }
        }
    } else {$ok="OK"; $filease=false;}

    if($ok!="OK") echo "Your post was not uploaded. Try again!";
    else {

            $post=mysqli_real_escape_string($con,$post);
            $tags=mysqli_real_escape_string($con,$tags);
            $tofolder=mysqli_real_escape_string($con,$tofolder);
            $file = preg_replace('~[\\\\/:*?"<>| ]~', '_', $file);
            if($filease==false) $tofolder="root";

            //check if folder exists
            if($tofolder!="root"){
                $query="select * from folder where group_id='".$groupid."' and folder='".$tofolder."'";
                if($query_run=mysqli_query($con,$query)){
                    $rows=mysqli_num_rows($query_run);
                    if($rows==0) {
                        echo $rows;
                        echo "<strong style=\"color:red\";>Sorry, the folder doesn't exist. File will be stored in main folder.</strong>";
                        $tofolder="root";
                    }
                }
                else echo "<strong style=\"color:red\";>Folder error. File will be stored in main folder.</strong>";
            }

            $query="insert into files values('','".$userid."','".$groupid."','".$post."','".$file."','".$ext."','".$tofolder."',null)";
            if($query_run=mysqli_query($con,$query)){

                $fileid = mysqli_insert_id($con);

                if($tags!=""){

                    $shob="yes";
                    $tags=$tags.',';
                    $tags_ara=explode(",",$tags,-1);
                    for($i=0 ;$i<count($tags_ara) ;$i++) 
                    {
                        $tag=$tags_ara[$i];
                        $query="insert into tags values('".$groupid."','".$tag."','".$fileid."')";
                        if($query_run=mysqli_query($con,$query)); else $shob="no";
                    }
                    if($shob=="no") echo "<strong style=\"color:red\";>Sorry, all tags could not be saved.</strong>";
                }

                $query="select * from files where id='".$fileid."'";
                if($query_run=mysqli_query($con,$query)){
                    mysqli_data_seek($query_run,0);
                    $row=mysqli_fetch_row($query_run);

                    $row[3]=nl2br($row[3]);

                    echo " <div class=\"apost\" id='".$row[0]."'>
                    <div class=\"cross\">X</div>
                    <h3 class=\"author\">".$username."</h3>
                    <div class=\"time\">".$row[7]."</div>
                    <div class=\"aposttext\">".$row[3]."</div>
                    <div class=\"commentbtn\">comment</div>
                    <div class=\"file-folder\">".$row[4]." in ".$row[6]."</div>
                    <div class=\"comment-list\">
                    <hr/>
                    <div class=\"comment-box curr\"><textarea class=\"com-text\"></textarea><button class=\"com-postbtn\">post</button></div>
                    <div class=\"comments\"></div></div></div></div>";

                    //user-list
                    $mems=array();
                    $query="select user_id from user_group where group_id='".$groupid."'";
                    if(!$query_run=mysqli_query($con,$query)) die();
                    while($query_row=mysqli_fetch_assoc($query_run)){
                        $u=$query_row['user_id'];
                        if($u!=$userid) $mems[]=$u;
                    }
                    //create notifications
                    foreach($mems as $to){
                        $query="insert into notifs values('','".$groupid."','".$to."','post','".$fileid."','')";
                        $x=$query_run=mysqli_query($con,$query);
                        if(!$x) echo 'feck'.mysqli_error($con);
                    }
                }
            }
            else echo $msg;
        }
}
else header('location: /groupstudy/groupproject/grouppage.php');

?>