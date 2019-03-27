<nav class="navbar navbar-expand-lg navbar-dark  sticky-top" style="background: #13334c!important;border-bottom: 4px solid #fd5f00;position: relative;">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">
<img src="assets/images/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
  CHATBOX</a>

  <div class="collapse navbar-collapse justify-content-between" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto">
    <form class="form-inline my-2 my-lg-0" id="searchForm" method="post">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="searchBox"  name="searchBox">
      <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
     
    </form>
  </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php">Home<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php?p=mynetwork">My Network</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php?p=messaging">Messaging</a>
      </li>
      <li class="nav-item" style="" id="showNotification">
        <div id="ex1">
        <a class="nav-link" href="#">
          <i class="fa fa-bell fa-fw notiBadge" style="color: #fd5f00"></i>
        </a>
        </div>
        <div class="card" id="notificationPanel" >
        <div class="text-center ajax-load" style="display: none;"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></div></div> 
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo 'logout.php';?>" title="Logout">
            <i class="fa fa-sign-out fa-fw" style="color: #fd5f00"></i>
          </a>
      </li>
    </ul>
  <ul class="navbar-nav ml-auto">
  <a href="profile.php?p=<?php echo USERID?>"><img src="<?php echo PICPATH?>" width="30" height="30" class="d-inline-block align-top" value="<?php echo USERID?>" name="<?php echo USERNAME?>" id="loggeduser"></a>
  </ul>
  </div>

 <div class="card" id="searchDialog">
      
    </div>

 
</nav>
<div class="alert alert-success AlertFixed" role="alert">
  
</div>  

<?php
$db = new db();
$res = $db -> select("SELECT * FROM `institute` WHERE (id = ".$_SESSION['user']['belong'].")");
?>
<?php if($res) {?>
<div class="text-center instName">
<div class="alert"><b style="color:#fd5f00"><?php print_r($res[0]['institutename']); ?></b></div>
</div>
<?php } ?>