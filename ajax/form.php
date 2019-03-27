<?php 
include("../config.php");
include(ROOT_PATH.'/include/common.php');
$db = new DB();
// Check for Login
if(isset($_POST['login'])) {
$text=$_POST['login'];
$newtxt=explode("|",$text);
$email=$newtxt[0];
$pass1=$newtxt[1];
$pass=md5($pass1);
// $email="Shivang5198@glmail.com";
// $pass1="Shivang123";
$result = $db->select("SELECT name,user_id,picpath,belong FROM users WHERE(email='$email' OR username='$email') AND password='$pass1'");
if($result)
{
	$_SESSION['user']=array('name'=>$result[0]['name'],'userid'=>$result[0]['user_id'],'picpath'=>$result[0]['picpath'],'belong'=>$result[0]['belong']);
    echo 'success';
}
else
{
  echo 'inavalid username/password';
}
}

//Register A New User
if(isset($_POST['register'])){
  $formdata=json_decode($_POST['register']);
  //print_r($postForm);
  $username=$formdata->txtuser;
  $password=$formdata->txtpass;
  $name=$formdata->txtname;
  $email=$formdata->txtemail;
  $gender=$formdata->gender;
  $mobno="";
  $city=$formdata->city;
  $belong = isset($formdata->chbxInst) ? $formdata->chbxInst:0;
	$date=date("jS F Y h:i:s A");
  
  if($gender == "Male")
    $pic="assets/images/profile-pic/male".rand(1,10).".png";
  else
    $pic="assets/images/profile-pic/female".rand(1,8).".png";

    // Check for existing user with the new id
    $result = $db->select("SELECT username,email FROM users WHERE username = '$username' OR email='$email'");
    if (count($result) > 0) {
        echo 'A user already exists with your chosen username or email.'.
              'Please try another.';
    }
    else
    {
    $result = $db->insertUpdateDelete("INSERT INTO users SET
              username = '$username',
              password = '$password',
              name = '$name',
              email = '$email',
              gender = '$gender',
              mobno ='$mobno',
              city = '$city',
              picpath = '$pic', 
              status = '1',
              time = '$date',
              belong ='$belong' ");
    if (!$result){
        error('A database error occurred in processing your '.
              'submission.' . $sql);
      }
      else
      {
        echo "User Registration Successfull";
      }
    }
}
?>