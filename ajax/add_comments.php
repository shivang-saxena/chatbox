<?php
require("../dashboard.code.php");
$db = new db();
$user_id=$_SESSION['user']['userid'];
$postid=$_POST['postid'];
$commentVal=$_POST['commentVal'];
echo $postid;
if(isset($_POST['postid']) && isset($_POST['commentVal'])){
		$query = "INSERT INTO comments (parent_comment_id,user_id,post_id,body) VALUES ('0','" . $user_id. "','" . $postid . "','" . $commentVal . "')";
			$result = $db->insertUpdateDelete($query);
			if(!empty($result)) {
				$query ="UPDATE posts SET comments = comments + 1 WHERE id='" . $postid . "'";
				$result = $db->insertUpdateDelete($query);
			    echo $result;
			}
	}
?>