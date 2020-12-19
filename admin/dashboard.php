
<?php require_once('classes.admin.php');?>
<?php
$admin = new Admin();
?>

<?php
if(isset($_POST['deleteUser'])){
$id = $_POST['userid']; 
if($admin->deleteUser($id)){
  echo '<script type="text/JavaScript">  
  alert("User Deleted"); 
  </script>' 
; 
 }else{
  echo '<script type="text/JavaScript">  
   alert("Unable to delete User"); 
   </script>' 
; 
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
  <ul><li class="nav-item">
        <a class="nav-link" href="<?php echo '../logout.php';?>" title="Logout">
           Logout
          </a>
      </li><ul>
</nav>

     <div class="container">
     <div class="row">
     <div class="col-md-4">
     <div class="card border-dark mb-3" style="max-width: 18rem;">
  <div class="card-header text-center">Add City</div>
  <div class="card-body text-dark">
  <a href="#" onclick="$('#Modaladdcity').modal();$('#myModal .close').click();"><h5 class="card-title">Add New City</h5></a>
    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
  </div>
</div>
     </div>

     <!-- Modal Add new City -->
     <div class="modal" id="Modaladdcity" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New City</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="dashboard.php" name="addcity" method="POST">
            <div class="alert-box"></div>
            <div class="form-group">
              <input type="text" class="form-control" name="txtcity" placeholder="Enter city"  required="">
            </div>
            <div class="alert alert-danger" id="errmsg" style="display: none;">
           </div>
           
            
            <button class="btn btn-success" type="submit">Add City</button>
             </form>
      </div>
    </div>
  </div>
</div> 
<!--   Modal End -->

   

     <div class="col-md-4">
     <div class="card border-dark mb-3" style="max-width: 18rem;">
  <div class="card-header text-center">Add Institute</div>
  <div class="card-body text-dark">
    <a href="#" onclick="$('#Modaladdinstitute').modal()"><h5 class="card-title">Add New Institute</h5></a>
    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
  </div>
</div>
     </div>
      <!-- Modal Add new Institute -->
      <div class="modal" id="Modaladdinstitute" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Add New Institute</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form onsubmit="return false">
            <div class="alert-box"></div>
            <div class="form-group">
              <input type="text" class="form-control" name="txtcity" placeholder="Enter city"  required="">
            </div>
            <div class="alert alert-danger" id="errmsg" style="display: none;">
           </div>
           
            
            <button class="btn btn-success" type="submit">Add City</button>
             </form>
      </div>
    </div>
  </div>
</div> 
<!--   Modal End -->

     <div class="col-md-4">
     <div class="card border-dark mb-3" style="max-width: 18rem;">
  <div class="card-header text-center">Links</div>
  <div class="card-body text-dark">
    <a href="posts.php"><h5 class="card-title">All Posts</h5></a>
    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
  </div>
</div>
     </div>

     </div>
     </div>
    </body>
  
    </html>

    <?php
    if (!empty($_POST['addcity'])) {
      //  $admin = new Admin();
      //  $admin->addcity('Banglore');
     }
     
    ?>
   <table class="table table-bordered">
  <thead>
    <tr>
    <th scope="col">#</th>
    <th scope="col">profile</th>
      <th scope="col">username</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Gender</th>
      <th scope="col">LastLogin</th>
      <th scope="col">Password</th>
      <th scope="col">Belong</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($admin->displayUsers() as $value2):?>
    <tr>
    <td><?php echo $value2['user_id']; ?></td>
      <th scope="row"> <img src="<?php echo '../'.$value2['picpath']; ?>" width="70" height="70" class="" alt="" style="border-radius: 50%"></th>
      <td><?php echo base64_decode($value2['username']); ?></td>
      <td><?php echo base64_decode( $value2['name']); ?></td>
      <td><?php echo base64_decode( $value2['email']); ?></td>
      <td><?php echo $value2['gender']; ?></td>
      <td><?php echo $value2['lastlogin']; ?></td>
      <td><?php echo $value2['password']; ?></td>
      <td><?php echo $value2['belong']; ?></td>
      <td>
      <form action="" method="post">
      <input type="hidden" value="<?php echo $value2['user_id']; ?>" name="userid" />
      <button type="submit" class="btn btn-primary btn-sm" name="deleteUser">X</button>
      <button type="button" class="btn btn-primary btn-sm">Edit</button>
      </form>
      </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>