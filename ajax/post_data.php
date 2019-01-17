<?php if($feedarray){ ?>
<?php foreach ($feedarray as $post): ?>
<div class="card post-id" id="<?php echo $post['id']; ?>">
  <div class="card-body">
   <div class="flex-row">
     <div>
       <img src="<?php echo $post['picpath']; ?>" width="50" height="50" class="d-inline-block align-left" alt="">
     </div>
     <div class="flex-column">
       <a href="<?php echo 'profile.php?p='.$post['user_id']; ?>"><span><b><?php echo $post['name']; ?></b></span></a>
       <small class="text-muted"><?php echo $post['city']; ?></small>
       <small class="text-muted"><?php echo $feedobj->dateDiff($post['created_at']) ?> ago</small>
     </div>
     <i class="fa fa-ellipsis-h fafafeed" aria-hidden="true"></i>
   </div>
   <hr>  
    <p class="card-text"><?php echo $post['body']; ?></p>
   
    <?php if($post['imgname'] != 'NULL') { ?>
    <img class="card-img-bottom" src="<?php echo $post['path'].$post['imgname']; ?>" alt="Card image cap">
  <?php }?>
  </div>
  
  <div class="card-footer" id="<?php echo 'post-'.$post['id']; ?>">
    <input type="hidden" id="likes-<?php echo $post['id'];?>" value="<?php echo $post['likes'];?>">
    <p class="card-text "><small class="text-muted label-likes"><?php echo $post['likes']; ?> Like(s)</small><small class="text-muted"><?php echo $post['comments']; ?> Comments</small></p>

    <?php
    $query="SELECT * FROM likes WHERE user_id='".USERID."' and post_id='".$post['id']."'";
    $db = new db();
    $rowcount = $db->numRows($query);
    $str_like = "like";
    if(!empty($rowcount)) {
    $str_like = "unlike";
    }
    ?>

    <div class="flex-row">
    <div class="like">
   <div class="btn btn-<?php echo $str_like;?>" title="<?php echo $str_like;?>" onclick="addLikes(<?php echo $post['id'];?>,'<?php echo $str_like;?>',<?php echo $post['user_id'];?>)">
    <?php if(!empty($rowcount)){?>
    <i class="fa fa-thumbs-up" aria-hidden="true"></i><?php }else{?>
    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i><?php  }?>  <?php echo $str_like;?></div>
    </div>
    <div class="comment">
   <div class="btn btn-comment" data-toggle="collapse" href="#collapseComments-<?php echo $post['id']?>" role="button" aria-expanded="false" aria-controls="collapseComments-<?php echo $post['id']?>">
     <i class="fa fa-comments" aria-hidden="true"></i>  Comments</div>
    </div>
  </div>
  <div class="collapse" id="collapseComments-<?php echo $post['id']?>" style="background: rgba(0,0,0,.03);">
    <div class="card-body">
    <!-- <form  style="margin-bottom: 2rem" > -->
  <div class="form-row">
    <div class="col-1 text-center">
      <img src="<?php echo PICPATH; ?>" width="35" height="35" style="border-radius: 50%" alt="">
    </div>
    <div class="col-9 ">
      <input type="hidden" name="comment_id"  placeholder="<?php echo $post['id']?>" />
      <input type="text" class="form-control" placeholder="Post a comment">
    </div>
    <div class="col-2">
      <button name="submit" class="btn btn-primary" placeholder="" onclick="comment(this);"><i class="fa fa-paper-plane" aria-hidden="true"></i></button></div>
    <div id="comment-message" style="color: green"></div>
  </div>
<!-- </form> -->

<div class="comment-output" style="margin-top: 20px">
   <?php
 $commentarray=$feedobj->listcomment($post['id']);
  ?>
 <?php foreach ($commentarray as $comments): ?>
<div class="form-row" style="margin-top: 1rem">
    <div class="col-2 text-right">
      <img src="<?php echo $comments['picpath']; ?>" width="35" height="35" style="border-radius: 50%" alt="">
    </div>
    <div class="col-10">
     <div class="flex-column">
   <span class=""> <a href=""><?php echo $comments['name'];?></a><small style="float: right"><?php echo  $feedobj->dateDiff($comments['created_at']);?></small></span>
    <span style="color: grey;"><?php echo $comments['body'];?>
  </span>
  </div> 
    </div>
  </div>
  <?php endforeach ?>  
</div> 
   
</div>
</div>
   </div>

</div>
<?php endforeach ?>
<?php }
else{
  echo trim('nodata');
  } ?>