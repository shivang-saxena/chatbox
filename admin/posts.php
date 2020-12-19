
<?php require_once('classes.admin.php');?>
<?php
$admin = new Admin();
?>

<?php

if(isset($_POST['deletePost'])){
  $id = $_POST['postid']; 
   if($admin->deletePost($id)){
    echo '<script type="text/JavaScript">  
    alert("Post Deleted"); 
    </script>' 
; 
   }else{
    echo '<script type="text/JavaScript">  
     alert("Unable to delete Post"); 
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
</nav>

<a href="dashboard.php">Back to dashboard</a>
     <div class="container-fluid">
     <div class="row">
    
   <table class="table table-bordered">
  <thead>
    <tr>
    <th scope="col">PostPic</th>
      <th scope="col">Text</th>
      <th scope="col">User</th>
      <th scope="col">Likes</th>
      <th scope="col">Comments</th>
      <th scope="col">Belong</th>
      <th scope="col">Created At</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($admin->displayPosts() as $post):?>
    <tr>
      <th scope="row">
      <?php if($post['imgname'] != 'NULL') { ?>
    <img src="<?php echo '../'.$post['path'].$post['imgname']; ?>" alt="Card image cap" height="100" width="150">
  <?php }?>
       </th>
      <td><p><?php echo base64_decode($post['body']); ?></p></td>
      <td><?php echo base64_decode($post['name']); ?></td>
      <td><?php echo $post['likes'];?></td>
      <td><?php echo $post['comments'];?></td>
      <td><?php echo $post['belong']; ?></td>
      <td><?php echo $post['created_at']; ?></td>
      <td>
      <form action="" method="post">
      <input type="hidden" value="<?php echo $post['id']; ?>" name="postid" />
      <button type="submit" class="btn btn-primary btn-sm" name="deletePost">X</button>
      <button type="button" class="btn btn-primary btn-sm">Edit</button>
      </form>
      </td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>
     </div>
     </div>

    
    </body>
  
    </html>

  