<?php
require("../dashboard.code.php");
$db = new db();
$name=$_POST['inputName3'];
$email=$_POST['inputEmail3'];
$about=$_POST['inputAbout3'];
$username=$_POST['inputUsername3'];
$mobile=$_POST['inputMobile3'];
$city=$_POST['inputSelect3'];
$userid=USERID;
if(!empty($_FILES['file'])) {
  $uploadobj=new ImageUpload();
  $message = '';
    $file = $uploadobj->uploadFile('file', true, true);
        if (is_array($file['error'])) {
        foreach ($file['error'] as $msg) {
        $message .= '<p>'.$msg.'</p>';    
        }
        }
         else {
        $image='assets/images/post-images/'.$file['filename'];
        $query="UPDATE users SET name='{$name}', email='{$email}', about='{$about}', username='{$username}', mobno='{$mobile}', city='{$city}', picpath='{$image}' WHERE user_id='{$userid}'";
        $result = $db->insertUpdateDelete($query);
        if($result){
            $message="PROFILE Updated Successfully";
        }
            else{
              $message="Unable to Update";
            }
  }
}
  else
  {
    $query="UPDATE users SET name='{$name}', email='{$email}', about='{$about}', username='{$username}', mobno='{$mobile}', city='{$city}' WHERE user_id='{$userid}'";
        $result = $db->insertUpdateDelete($query);
        if($result){
            $message="PROFILE Updated Successfully";
        }
            else{
              $message="Unable to Update".$query;
            }
  }
 print_r($message);
?>