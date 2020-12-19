
<?php require('../config.php');?>
<?php require('../include/common.php');?>

<?php
if (!isset($_SESSION['user']))
{
   error("Login First");
   exit(0);
}
?>
<?php
define("USERID",$_SESSION['user']['userid'], true);
define("UNAME",$_SESSION['user']['username'], true);

$db =  new db();
?>
<?php
class  Admin
{
	//userid of current login user in session
   private $uid;
	function __construct()
	{
    $this->uid=$_SESSION['user']['userid'];
		
	}
    
    // public function login($username,$password){
        
    // }

    public function displayUsers(){
    	$db = new db();
        $result = $db->select("SELECT * FROM users");
        return $result;
    }

    public function deleteUser($id){
    	$db = new db();
        $result = $db->insertUpdateDelete("DELETE FROM users where user_id='$id'");
        $result = $db->insertUpdateDelete("DELETE FROM posts where user_id='$id'");
        $result = $db->insertUpdateDelete("DELETE FROM conversation where user_one='$id' OR user_two='$id'");
        return $result;
    }
    public function displayPosts(){
    	$db = new db();
        $result = $db->select("SELECT t1.*,t2.user_id,t2.username,t2.name FROM posts t1,users t2 WHERE t1.user_id=t2.user_id  ORDER BY t1.id DESC");
        return $result;
    }
    public function deletePost($id){
    	$db = new db();
        $result = $db->insertUpdateDelete("DELETE FROM posts where id='$id'");
        return $result;
    }
}


?>