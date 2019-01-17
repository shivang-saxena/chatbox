<?php
require("../dashboard.code.php");
$db = new db();
date_default_timezone_set('Asia/Kolkata');
$time =date('H:i:s');
$date =date('m/d/Y');
$mydate= date("Y-m-d H:i:s");

function convertHashtoLink($string)  
 {  
      $expression = "/#+([a-zA-Z0-9_]+)/";  
      $string = preg_replace($expression, '<a href="hashtag.php?tag=$1">$0</a>', $string);  
      return $string;  
 }  
 $posttext=convertHashtoLink($_POST['msg']);  
$uploadpostobj=new MyFeed();
//if(isset($_POST['file'])) {
  $uploadobj=new ImageUpload();
  $message = '';
  if(!empty($_FILES['file'])) {
    $file = $uploadobj->uploadFile('file', true, true);
        if (is_array($file['error'])) {
        foreach ($file['error'] as $msg) {
        $message .= '<p>'.$msg.'</p>';    
        }
        }
         else {
        $image=$file['filename'];
        if($uploadpostobj->postFeed($image,$posttext,$mydate))
          $message="POST uploaded Successfully";
        else
          $message="Unable to Upload";
        }
  }
  else
  {
    $image='NULL';
        if($uploadpostobj->postFeed($image,$posttext,$mydate))
          $message="POST uploaded Successfully";
        else
          $message="Unable to Upload";
  }
 print_r($message);
?>