<?php require('include/common.php') ?>
<?if(empty($_GET['tag'])){
error("Sorry Page Not found");
exit();
}?>
<?php require('dashboard.code.php') ?>
<?php require_once( ROOT_PATH . '/include/headsection.php') ?>
<title>hashtag search results</title>

<?php
$tag = preg_replace("#[^a-zA-Z0-9_]#", '', $_GET["tag"]);     
$networkobj=new MyNetwork();
$feedobj=new MyFeed();
  $feedarray=$feedobj->getHashtagfeed($tag);
        if(!$feedarray){
        error("Unable to fetch data from database");
         exit();   
        }
        ?>
</head>
<body class="colorbg4">
<?php include(ROOT_PATH."/include/navbar.php");?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-sm-12">
        <div class="card profile-card-4 text-center">
                    <div class="card-img-block">
                        <img class="img-fluid" src="assets/images/userbg.png" alt="Card image cap">
                    </div>
                    <div class="card-body pt-5">
                        <img src="<?php echo PICPATH;?>" alt="profile-image" class="profile"/>
                        <small class="text-muted">Welcome</small>
                        <a href="profile.php?p=<?php echo USERID;?>"><h5 class="card-title"><?php echo USERNAME;?></h5></a><hr>
                           <div class="flex-row-center">
                               <div class="btn" style="border-right: 2px solid grey"><b><?php echo $networkobj->getFriendListCount();?></b> Friends</div>
                               <div class="btn"><b><?php echo count($feedarray);?></b> Posts</div>
                           </div>
                    </div>
            </div>

      <div class="card">
                <div class="card-header">
                    <span class="font-weight-bold"><i class="fa fa-hashtag" aria-hidden="true"></i>Trending Hashtags</span>
                </div>
                
                    <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item"><a href="hashtag.php?tag=chatbox">#chatbox</a></li>
                    <li class="list-group-item"><a href="hashtag.php?tag=social">#social</a></li>
                    <li class="list-group-item"><a href="hashtag.php?tag=link">#link</a></li>
                    <li class="list-group-item"><a href="hashtag.php?tag=fblikes">#fblikes</a></li>
                    <li class="list-group-item"><a href="hashtag.php?tag=college">#college</a></li>   
                     </ul>
               
      </div>
        </div>
        <div class="col-md-6">
          <div class="card">
            <div class="card-header">
              <small>search results for</small>
              <h1>#<?php echo $tag?></h1>
            </div>            
          </div>
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
    <span><small class="text-muted label-likes"><?php echo $post['likes']; ?> Like(s)</small><small class="text-muted"><?php echo $post['comments']; ?> Comments</small></span>

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
   <div class="btn btn-<?php echo $str_like;?>" title="<?php echo $str_like;?>" onclick="addLikes(<?php echo $post['id'];?>,'<?php echo $str_like;?>')">
    <?php if(!empty($rowcount)){?>
    <i class="fa fa-thumbs-up" aria-hidden="true"></i><?php }else{?>
    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i><?php  }?>  <?php echo $str_like;?></div>
    </div>
    <div class="comment">
   <div class="btn btn-comment" data-toggle="collapse" href="#collapseComments-<?php echo $post['id']?>" role="button" aria-expanded="false" aria-controls="collapseComments-<?php echo $post['id']?>">
     <i class="fa fa-comments" aria-hidden="true"></i>  Comments</div>
    </div>
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
<?php endforeach ?>
 
        </div>
        <div class="col-md-3">
          <div class="card">
               <div class="card-header">
                  <span class="font-weight-bold">People's you may know</span> 
               </div>
                <div class="card-body flex-column">
                  <?php foreach ($networkobj->cardDisplayUsers() as $value2):?>
                <div class="flex-row border-bottom">
                   <img src="<?php echo $value2['picpath'];?>" width="50" height="50" class="d-inline-block align-left" alt="" style="border-radius: 50%">
                <div class="flex-column">
                <a href="<?php echo 'profile.php?p='.$value2['user_id']; ?>"><span><b><?php echo $value2['name'];?></b></span></a>
               <small class="text-muted"><?php echo $value2['city'];?></small>
               <?php 
                           $btn_value='connect';
                           if($res=$networkobj->rqstPendingStatus($value2['user_id'])){
                           if($res[0]['status'] =='1'){
                           $btn_value='message';
                           }
                           if($res[0]['status'] =='0'){
                           $btn_value='pending';
                           }
                         }?>
                <div class="btn connect" onclick="addAsFriend(<?php echo $value2['user_id']; ?>,'<?php echo $btn_value;?>',this);"><?php echo $btn_value;?></div>
                </div>
               </div>
               
               <?php endforeach ?>
               <a class="text-center text-muted" href="dashboard.php?p=mynetwork">show more</a>
           </div>
           
           </div>
        </div>
</div>
</div>
<script type="text/javascript" src="assets/js/dashboard.js"></script>
</body>
</html>
