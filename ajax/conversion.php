<?php
//include("../db.php");
include("../dashboard.code.php");
$db = new db();
date_default_timezone_set('Asia/Kolkata');
$time =date('H:i:s');
$date =date('m/d/Y');
$fulltime =date('m/d/Y H:i:s');

//crearing a new conversion or select existing conversion_id between users
if(isset($_POST['createchat'])) {
$user_one=$_SESSION['user']['userid'];
$user_two=$_POST['createchat'];
if($user_one!=$user_two)
{
	$result = $db->select("SELECT c_id FROM conversation WHERE (user_one='$user_one' and user_two='$user_two') or (user_one='$user_two' and user_two='$user_one') ");
date_default_timezone_set('Asia/Kolkata');
$time =date('H:i:s m/d/Y');
$ip=$_SERVER['REMOTE_ADDR'];
//echo $eq;	
if(count($result)==0) 
{ 
$result = $db->insertUpdateDelete("INSERT INTO conversation (user_one,user_two,ip,time) VALUES ('$user_one','$user_two','$ip','$time')");
$result = $db->select("SELECT c_id FROM conversation WHERE user_one='$user_one' ORDER BY c_id DESC limit 1");
echo $result[0]['c_id'];
}
else
{
echo $result[0]['c_id'];
}
}
}


//select all conversion messages between user1 and user2
elseif(isset($_POST['chatlog'])){
$c_id=$_POST['chatlog'];
$result = $db->select("SELECT * FROM ( SELECT R.cr_id,R.time,R.reply,U.user_id,U.username,U.email FROM users U, conversation_reply R WHERE R.user_id_fk=U.user_id and R.c_id_fk='$c_id' ORDER BY R.cr_id DESC LIMIT 20) AS T ORDER By T.cr_id ASC");
$json_data = array();  
foreach ($result as $value)
{
$json_array['cr_id']=$value['cr_id'];  
$json_array['time']=date('h:i:s a', strtotime($value['time']));
$json_array['reply']=$value['reply'];  
$json_array['user_id']=$value['user_id'];
$json_array['username']=$value['username'];
$json_array['email']=$value['email'];
//here pushing the values in to an array  
    array_push($json_data,$json_array); 
}
echo json_encode($json_data);  
}

//Inserting reply between user1 user2
elseif(isset($_POST['msg_data'])){
//receiving data in json string format and decode it to json object
$data=json_decode($_POST['msg_data']);
$reply=$data->reply;
$cid=$data->c_id;
$uid=$_SESSION['user']['userid'];

$ip=$_SERVER['REMOTE_ADDR'];
if($result = $db->insertUpdateDelete("INSERT INTO conversation_reply (user_id_fk,reply,ip,time,date,c_id_fk) VALUES ('$uid','$reply','$ip','$time','$date','$cid')"))
{
  echo "Sent";
}
else
{
  echo 'Fail';
}
}



//Sending request to the user
//status ->  0:Pending 1:Accepted 2:Declined 3:Blocked
elseif(isset($_POST['request'])){
$data=json_decode($_POST['request']);
$user_one_id=$data->user_one_id;
$user_two_id=$data->user_two_id;
$status=$data->status;
$action_user_id=$data->action_user_id;
if($user_one_id != $user_two_id){
	$result = $db->select("SELECT * FROM relationship WHERE (user_one_id='$user_one_id' and user_two_id='$user_two_id')");
if(count($result)==0) {
	$result = $db->insertUpdateDelete("INSERT INTO relationship (user_one_id, user_two_id, status, action_user_id)
VALUES ('$user_one_id', '$user_two_id', '$status', '$action_user_id')");
	echo "Request Send";
   }
   else
   {
   	echo "Request Already send";
   }
  }
}


//Accept or Reject the friend Request
elseif(isset($_POST['rqststatus'])){
	$data=json_decode($_POST['rqststatus']);
$user_one_id=$data->user_one_id;
$user_two_id=$data->user_two_id;
$status=$data->status;
$action_user_id=$data->action_user_id;
if($user_one_id != $user_two_id){
	if($result = $db->insertUpdateDelete("UPDATE relationship SET status = '$status', action_user_id = '$action_user_id' WHERE user_one_id = '$user_one_id' AND user_two_id = '$user_two_id'"))
          {
           echo "You accepted a request";
          }
          else{
            echo "Unable to Accept";
          }
  }
}


?>