<?php require('../dashboard.code.php') ?>
<?php
$db=new db();
$sql="SELECT u.user_id,u.name,n.* FROM users u , notifications n
                WHERE u.user_id = n.sender AND  n.receiver=".USERID." LIMIT 10";
$sql2="SELECT u.user_id,u.name,n.* FROM users u , relationship n
                WHERE u.user_id = n.action_user_id AND  n.action_user_id=".USERID." LIMIT 10";
$result=$db->select($sql);
//$result+=$db->select($sql2);
if($result){ ?>
 <div class="card-header text-center">
        Notification(<?php echo count($result);?>)
      </div>
      <?php foreach ($result as $post): ?>
      	<?php if($post['status']== 'like'): ?>
      <div class="alert alert-success" role="alert" onclick="smoothScroll(document.getElementById('<?php echo 'post-'.$post['srcid'];?>'))">
      <a href="<?php echo 'profile.php?p='.$post['user_id'];?>" class="alert-link"><?php echo $post['name'];?></a> Liked your
      <a href="#" class="alert-link" >Post</a>
      <div><small>5h ago</small></div>
      </div>
      <?php elseif($post['status']== 'comment'): ?>
      <div class="alert alert-success" role="alert" onclick="smoothScroll(document.getElementById('<?php echo 'post-'.$post['srcid'];?>'))">
      <a href="<?php echo 'profile.php?p='.$post['user_id'];?>" class="alert-link"><?php echo $post['name'];?></a> Commented your
      <a href="#" class="alert-link" >Post</a>
       <div><small>5h ago</small></div>
      </div>


      <?php elseif($post['status']== 'request'): ?>
      <div class="alert alert-warning" role="alert">
      <a href="<?php echo 'profile.php?p='.$post['user_id'];?>" class="alert-link"><?php echo $post['name'];?></a>
      Send you a Friend Request.
      </div>
      <?php elseif($post['status']== 'reject'): ?>
      <div class="alert alert-warning" role="alert">
      <a href="<?php echo 'profile.php?p='.$post['user_id'];?>" class="alert-link"><?php echo $post['name'];?></a>
      Rejected your Friend Request.
      </div>
      <?php elseif($post['status']== 'accept'): ?>
      <div class="alert alert-success" role="alert">
      <a href="<?php echo 'profile.php?p='.$post['user_id'];?>" class="alert-link"><?php echo $post['name'];?></a>
      Accepted your Friend Request.
      </div>
      </div>
  <?php endif ?>
  <?php endforeach?>
<?php
}
else{
?>
 <div class="card-header text-center">
        Notification(0)
      </div>
      <div class="text-center ajax-load" style="display: none;"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></div>  
      <div class="alert" role="alert">
      No Notification
      </div>
<?php
}
?>