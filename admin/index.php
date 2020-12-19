<?php
if(isset($_POST['loginAdmin'])){
$username = $_POST['username']; 
$password = $_POST['password']; 
$id="admin@livechatbox.com";
 $pwd='live@123';
//$id="11";
//$pwd="11";

if($id == $username && $pwd == $password){
    session_start();
$_SESSION['user'] = array('username'=>'admin','userid'=>$id);
header("Location: dashboard.php"); 
exit;
}else{
            echo 'false';
        }
}
?>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
     <link rel="icon" href="../assets/images/logo.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.css" >
    <link href="../assets/css/font-awesome.css" rel="stylesheet">
    <link href="../assets/css/messaging.css" rel="stylesheet" />
    <link href="../assets/css/dashboard.css" rel="stylesheet" />
    <script src="../assets/js/jquery-3.3.1.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" ></script> -->
    <script src="../assets/js/bootstrap.js"></script>
    </head>

    <body>
    <!-- Image and text -->
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="../assets/images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
    CHATBOX Admin
  </a>
</nav>

<div class="container" style="margin-top:100px">
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4">
<form action="" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">UserName</label>
    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="username" pattern=".{4,}" required>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" pattern=".{4,}" required >
  </div>
  <!-- <div class="form-group form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div> -->
  <button type="submit" class="btn btn-primary" name="loginAdmin">Login</button>
</form>
</div>
<div class="col-md-4"></div>
</div>
</div>
</body>
</html>