<?php
if(!empty($_POST["id"])) {
require("../dashboard.code.php");
$db = new db();
$user_id=$_SESSION['user']['userid'];
	switch($_POST["action"]){
		case "like":
			$query = "INSERT INTO likes (user_id,post_id) VALUES ('" . $user_id . "','" . $_POST["id"] . "')";
			$result = $db->insertUpdateDelete($query);
			if(!empty($result)) {
				$query ="UPDATE posts SET likes = likes + 1 WHERE id='" . $_POST["id"] . "'";
				$result = $db->insertUpdateDelete($query);	
				$db->insertUpdateDelete("INSERT INTO notifications (sender,receiver,srcid,status) VALUES ('" . $user_id . "','" . $_POST["userid"] . "','" . $_POST["id"] . "','like')");
				echo $query;			
			}			
		break;		
		case "unlike":
			$query = "DELETE FROM likes WHERE user_id = '" . $user_id . "' and post_id = '" . $_POST["id"] . "'";
			$result = $db->insertUpdateDelete($query);
			$db->insertUpdateDelete("DELETE FROM notifications WHERE sender = '" . $user_id . "' and srcid = '" . $_POST["id"] . "'");
			if(!empty($result)) {
				$query ="UPDATE posts SET likes = likes - 1 WHERE id='" . $_POST["id"] . "' and likes > 0";
				$result = $db->insertUpdateDelete($query);
				echo $query;			
			}
		break;		
	}

}

?>