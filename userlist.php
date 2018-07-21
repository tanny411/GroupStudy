<?php
include('connect.inc.php');
include('core.inc.php');

if(isset($_GET['text']) && !empty($_GET['text']))
	$text=mysqli_real_escape_string($con,$_GET['text']);
else $text="";

$query="select id,Username from user where Username like '".$text."%' and id not in(select user_id from user_group where group_id='".$_SESSION['group_id']."')";
if(!$query_run=mysqli_query($con,$query)) die('query failed').mysqli_error($con);
$rows=mysqli_num_rows($query_run);
if($rows>0){
    while($query_row=mysqli_fetch_assoc($query_run))
    {   
        $name=$query_row['Username'];
        echo "<li class=\"list-item\"><strong>".$text."</strong>".substr($name,strlen($text))."
        <input type=\"hidden\" value=\"".$name."\"></li>" ;
    }
}
else echo "<div class=\"nai\"><i>No such user</i></div>";

?>