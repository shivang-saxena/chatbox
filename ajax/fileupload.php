<?php
require("../dashboard.code.php");
$db = new db();
date_default_timezone_set('Asia/Kolkata');
$time =date('H:i:s');
$date =date('m/d/Y');
$mydate= date("Y-m-d H:i:s");

function convertHashtoLink($string)  
 {  
      $a=array();
      $expression = "/#+([a-zA-Z0-9_]+)/";  
      $Hashstring = preg_replace($expression, '<a href="hashtag.php?tag=$1">$0</a>', $string);  
      $hashtag=  preg_replace($expression, '$0' , $string);
      array_push($a,$hashtag);
      return $Hashstring;  
 }  

 function getHashtags($string) {  
  $hashtags= FALSE;  
  preg_match_all("/(#\w+)/u", $string, $matches);  
  if ($matches) {
      $hashtagsArray = array_count_values($matches[0]);
      $hashtags = array_keys($hashtagsArray);
  }
  return $hashtags;
}
 $posttext=convertHashtoLink($_POST['msg']);  
$uploadpostobj=new MyFeed();
$db = new db();
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
        if($uploadpostobj->postFeed($image,$posttext,$mydate)){
          $hashtagArray = getHashtags($_POST['msg']);
          foreach( $hashtagArray as $hashtag){
           $res = $db->select("SELECT * FROM hashtags WHERE hashtag='$hashtag' AND belong ='".$_SESSION['user']['belong']."' ");
           if (count($res) > 0) {
            $result = $db->insertUpdateDelete("UPDATE hashtags SET trendCount = trendCount + 1 WHERE hashtag='$hashtag'");
           }
           else{
            $result = $db->insertUpdateDelete("INSERT INTO hashtags (hashtag,trendCount,belong) VALUES ('" . $hashtag . "',1,'". $_SESSION['user']['belong']."')");
           }
          }
          $message="POST uploaded Successfully";
        }
        else
          $message="Unable to Upload";
        }
  }
  else
  {
    $image='NULL';
        if($uploadpostobj->postFeed($image,$posttext,$mydate)){
        $hashtagArray = getHashtags($_POST['msg']);
        foreach( $hashtagArray as $hashtag){
         $res = $db->select("SELECT * FROM hashtags WHERE hashtag='$hashtag' AND belong ='".$_SESSION['user']['belong']."' ");
         if (count($res) > 0) {
          $result = $db->insertUpdateDelete("UPDATE hashtags SET trendCount = trendCount + 1 WHERE hashtag='$hashtag'");
         }
         else{
          $result = $db->insertUpdateDelete("INSERT INTO hashtags (hashtag,trendCount,belong) VALUES ('" . $hashtag . "',1,'". $_SESSION['user']['belong']."')");
         }
        }
          $message="POST uploaded Successfully";}
        else
        {
          $message="Unable to Upload";}
  }
 print_r($message);
?>