<?php require('config.php');?>
<?php
if (!isset($_SESSION['user']))
{
    error("Login First");
    exit(0);
}
?>
<?php
define("USERID",$_SESSION['user']['userid'], true);
define("USERNAME",$_SESSION['user']['name'], true);
define("PICPATH",$_SESSION['user']['picpath'], true);
?>
<?php
class  MyNetwork
{
	//userid of current login user in session
	private $uid;
	function __construct()
	{
		$this->uid=$_SESSION['user']['userid'];
		
	}
    public function getInvitations(){
    	$db = new db();
        $result = $db->select("SELECT * FROM relationship WHERE (user_one_id = '$this->uid' OR user_two_id = '$this->uid')AND (status = 0) AND action_user_id != '$this->uid'");
        $result2=null;
        if($result){
            foreach ($result as $value) {
            $action_user_id=$value['action_user_id'];
            $result2[] = $db->select("SELECT user_id,name,city,picpath FROM users WHERE (user_id = '$action_user_id')");
            }
            return $result2;
        }
        else{
        	return $result2;
        }
    }

    public function displayUsers(){
    	$db = new db();
        $result = $db->select("SELECT user_id,name,city,picpath FROM users WHERE user_id != '$this->uid'");
        return $result;
    }

    public function cardDisplayUsers(){
      $db = new db();
        $result = $db->select("SELECT user_id,name,city,picpath FROM users WHERE user_id != '$this->uid' ORDER BY rand() LIMIT 3");
        return $result;
    }

    public function getFriendList($id){
         $db = new db();
         $query="SELECT DISTINCT user_id,name,city,picpath FROM users u
                LEFT JOIN relationship r1 ON u.user_id = r1.user_one_id
                LEFT JOIN relationship r2 ON u.user_id = r2.user_two_id
                WHERE (r1.user_two_id = '$id' 
                AND r1.status = 1) 
                OR (r2.user_one_id = '$id' 
                AND r2.status = 1) ";
        $result = $db->select($query);
        return $result;
    }

    public function getFriendListCount(){
      $db =new db();
      $query="SELECT * FROM `relationship` WHERE (`user_one_id` = '$this->uid' OR `user_two_id` = '$this->uid') AND `status` = 1";
       $result = $db->select($query);
       if($result)
        return count($result);
      else
        return '0';
    }

    public function checkingFriendship($id){
      $db =new db();
    $user_one_id=min($this->uid,$id);
    $user_two_id=max($this->uid,$id);
    $query="SELECT * FROM `relationship` WHERE `user_one_id` = '$user_one_id' AND `user_two_id` = '$user_two_id' AND `status` = 1";
    $result = $db->select($query);
        if($result)
          return true;
        else
          return false;
    }

    public function rqstPendingStatus($id){
    $db =new db();
    $user_one_id=min($this->uid,$id);
    $user_two_id=max($this->uid,$id);
      $query="SELECT status FROM `relationship` WHERE `user_one_id` = '$user_one_id' AND `user_two_id` = '$user_two_id'";
      $result = $db->select($query);
      if($result)
        return $result;
      else
        return false;
    }
}

class  MyFeed extends ImageUpload
{
  
	//userid of current login user in session
	private $uid;
	function __construct()
	{
		$this->uid=$_SESSION['user']['userid'];
		
	}
  

    public function getFeed(){
    	$db = new db();
        $result = $db->select("SELECT t1.*,t2.user_id,t2.name,t2.picpath,t2.city FROM posts t1,users t2 WHERE t1.user_id=t2.user_id AND t1.status='1' ORDER BY t1.id DESC LIMIT 3");
            return $result;
    }

    public function getuserfeed($userid){
      $db = new db();
        $result = $db->select("SELECT t1.*,t2.user_id,t2.name,t2.picpath,t2.city FROM posts t1,users t2 WHERE t1.user_id=t2.user_id AND t1.status='1' AND t1.user_id='".$userid."' ORDER BY t1.id DESC LIMIT 10");
            return $result;
    }

    public function getHashtagFeed($tag){
      $db = new db();
        $result = $db->select("SELECT t1.*,t2.user_id,t2.name,t2.picpath,t2.city FROM posts t1,users t2 WHERE t1.user_id=t2.user_id AND t1.status='1' AND t1.body  LIKE '%#".$tag."%' ORDER BY t1.id DESC");
            return $result;
    }

    public function postFeed($imgname='',$text,$date){
        $path='assets/images/post-images/';
        $ip=$_SERVER['REMOTE_ADDR'];
        $message = '';
        $db=new db();
        $query="INSERT INTO posts (user_id,path,imgname,body,status,created_at,updated_at) VALUES ('$this->uid','$path','$imgname','$text','1','$date','$date')";
        $result = $db->insertUpdateDelete($query);
        if($result){
            $message=true;
        }
            else{
              $message=false;
            }

    return $message;
    }
    
    public function listcomment($postid){
      $db = new db();
        $result = $db->select("SELECT u.name,u.picpath,c.* FROM comments c ,users u where post_id='$postid' AND c.user_id=u.user_id ORDER BY parent_comment_id asc, id asc");
            return $result;
    }

    
function dateDiff($date)
{
  $mydate= date("Y-m-d H:i:s");
  $theDiff="";
  //echo $mydate;//2014-06-06 21:35:55
  $datetime1 = date_create($date);
  $datetime2 = date_create($mydate);
  $interval = date_diff($datetime1, $datetime2);
  //echo $interval->format('%s Seconds %i Minutes %h Hours %d days %m Months %y Year    Ago')."<br>";
  $min=$interval->format('%i');
  $sec=$interval->format('%s');
  $hour=$interval->format('%h');
  $mon=$interval->format('%m');
  $day=$interval->format('%d');
  $year=$interval->format('%y');
  if($interval->format('%i%h%d%m%y')=="00000")
  {
    //echo $interval->format('%i%h%d%m%y')."<br>";
    return $sec." Seconds";

  } 

else if($interval->format('%h%d%m%y')=="0000"){
   return $min." Minutes";
   }


else if($interval->format('%d%m%y')=="000"){
   return $hour." Hours";
   }


else if($interval->format('%m%y')=="00"){
   return $day." Days";
   }

else if($interval->format('%y')=="0"){
   return $mon." Months";
   }

else{
   return $year." Years";
   }

}
}
class  Messaging
{
    //userid of current login user in session
    private $uid;
    function __construct()
    {
        $this->uid=$_SESSION['user']['userid'];
        
    }
    public function getConversion(){
        $db = new db();
        $query="SELECT u.user_id,c.c_id,u.name,u.email,u.picpath
                               FROM conversation c, users u
                               WHERE (CASE 
                               WHEN c.user_one = '$this->uid'
                               THEN c.user_two = u.user_id
                               WHEN c.user_two = '$this->uid'
                               THEN c.user_one= u.user_id
                               END )
                               AND (
                               c.user_one ='$this->uid'
                               OR c.user_two ='$this->uid'
                               )
                               Order by c.c_id DESC Limit 20";
        $result = $db->select($query);
        if($result){
        foreach ($result as $value){
            $c_id=$value['c_id'];
            $user_id=$value['user_id'];
            $name=$value['name'];
            $email=$value['email'];
            $picpath=$value['picpath'];
            $result2 = $db->select("SELECT R.cr_id,R.time,R.reply FROM conversation_reply R WHERE R.c_id_fk='$c_id' ORDER BY R.cr_id DESC LIMIT 1");
            $reply=$result2[0]['reply'];
            $conversions[]=array('c_id'=>$c_id,'user_id'=>$user_id,'name'=>$name,'email'=>$email,'picpath'=>$picpath,'reply'=>$reply);
            }
        return $conversions;
        }
        else{
        return $result;
        }
    }
}

class ImageUpload{
    function uploadFile ($file_field = null, $check_image = false, $random_name = false) {

//Config Section    
//Set file upload path
$path = ROOT_PATH.'/assets/images/post-images/'; //with trailing slash
//Set max file size in bytes
$max_size = 2000000;
//Set default file extension whitelist
$whitelist_ext = array('jpeg','jpg','png','gif');
//Set default file type whitelist
$whitelist_type = array('image/jpeg', 'image/jpg', 'image/png','image/gif');

//The Validation
// Create an array to hold any output
$out = array('error'=>null);

if (!$file_field) {
  $out['error'][] = "Please specify a valid form field name";           
}

if (!$path) {
  $out['error'][] = "Please specify a valid upload path";               
}

if (count($out['error'])>0) {
  return $out;
}

//Make sure that there is a file
if((!empty($_FILES[$file_field])) && ($_FILES[$file_field]['error'] == 0)) {

// Get filename
$file_info = pathinfo($_FILES[$file_field]['name']);
$name = $file_info['filename'];
$ext = $file_info['extension'];

//Check file has the right extension           
if (!in_array($ext, $whitelist_ext)) {
  $out['error'][] = "Invalid file Extension";
}

//Check that the file is of the right type
if (!in_array($_FILES[$file_field]["type"], $whitelist_type)) {
  $out['error'][] = "Invalid file Type";
}

//Check that the file is not too big
if ($_FILES[$file_field]["size"] > $max_size) {
  $out['error'][] = "File is too big";
}

//If $check image is set as true
if ($check_image) {
  if (!getimagesize($_FILES[$file_field]['tmp_name'])) {
    $out['error'][] = "Uploaded file is not a valid image";
  }
}

//Create full filename including path
if ($random_name) {
  // Generate random filename
  $tmp = str_replace(array('.',' '), array('',''), microtime());

  if (!$tmp || $tmp == '') {
    $out['error'][] = "File must have a name";
  }     
  $newname = $tmp.'.'.$ext;                                
} else {
    $newname = $name.'.'.$ext;
}

//Check if file already exists on server
if (file_exists($path.$newname)) {
  $out['error'][] = "A file with this name already exists";
}

if (count($out['error'])>0) {
  //The file has not correctly validated
  return $out;
} 

if (move_uploaded_file($_FILES[$file_field]['tmp_name'], $path.$newname) or die (' cannot move uploaded file or something beavis')) {
  //Success
  $out['filepath'] = $path;
  $out['filename'] = $newname;
  // $out['extension'] = $ext; 
  return $out;
} else {
  $out['error'][] = "Server Error!";
}

 } else {
  $out['error'][] = "No file uploaded";
  return $out;
 }      
}

}
 // $obj=new Messaging();
 // $result=$obj->getConversion();
 // print_r($result[1]);
?>