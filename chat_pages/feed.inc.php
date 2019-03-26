<?php
$feedobj=new MyFeed();
$networkobj=new MyNetwork();

$feedarray=$feedobj->getuserfeed(USERID);
?>

<div class="container-fluid feed">
  <div class="row">
   <!--  sidepanel -->
    <div class="col-sm-3" id="side-panel">
     <div class="card profile-card-4 text-center">
                    <div class="card-img-block">
                        <img class="img-fluid" src="assets/images/userbg.png" alt="Card image cap">
                    </div>
                    <div class="card-body pt-5">
                        <img src="<?php echo PICPATH;?>" alt="profile-image" class="profile"/>
                        <small class="text-muted">Welcome</small>
                        <a href="profile.php?p=<?php echo USERID;?>"><h5 class="card-title"><?php echo USERNAME;?></h5></a><hr>
                           <div class="flex-row-center">
                               <div class="btn" style="border-right: 2px solid grey"><b><?php echo $networkobj->getFriendListCount();;?></b> Friends</div>
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
    <!--  sidepanel close-->
    <div class="col-sm-6">
    <div class="card">
 
  <div class="card-body" id="feedpost">
    
    <div class="form-group">
    <textarea class="form-control"  id="posttxt" placeholder="Share an artical,photo,idea!" pattern="[A-Za-z].{10,}" title="Artical should be 3 letters long" required="" rows="3"></textarea>
  </div>
  <div class="d-flex justify-content-between">
    <button type="button" class="btn btn-secondary" id="OpenImgUpload"><i class="fa fa-camera" aria-hidden="true"></i>
</button>
<input type="file" id="sortpicture" style="display: none;"/> 
    <button type="button" class="btn btn-info" id="upload">POST</button>
  </div>
  
  <div class="flex-row">
    <span style="position: relative;" id="imgpreview"></span>
  </div>
  </div>
</div>

<div id="post-data">
  <?php
 $feedarray=$feedobj->getFeed();
  ?>
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

  
   </div>
   <div class="collapse" id="collapseComments-<?php echo $post['id']?>" style="background: rgba(0,0,0,.03);">
    <div class="card-body">
    <!-- <form  style="margin-bottom: 2rem" > -->
  <div class="form-row">
    <div class="col-2 text-center">
      <img src="<?php echo PICPATH; ?>" width="35" height="35" style="border-radius: 50%" alt="">
    </div>
    <div class="col-8 ">
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
<div class="text-center ajax-load"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i></div>
</div>

</div>
    <div class="col-sm-3" id="bottomdiv">

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

      <div class="card" >
  <div class="card-header">
    <span class="font-weight-bold">Pending Request</span> 
  </div>
  <?php
      $result=$networkobj->getInvitations();
      if ($result) {
  ?>
  <div class="card-body flex-column">
    <?php foreach ($result as $post): ?>
    <div class="flex-row">
      <img src="<?php echo $post[0]['picpath']; ?>" width="50" height="50" class="d-inline-block align-left" alt="">
      <div class="flex-column">
        <a href="<?php echo 'profile.php?p='.$post[0]['user_id']; ?>"><span><b><?php echo $post[0]['name']; ?></b></span></a>
       <small class="text-muted"><?php echo $post[0]['city']; ?></small>
      </div>
    </div>
    <div class="flex-row">
      <div class="btn ignore">
    <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>  Ignore</div>
      <div class="btn accept">
    <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>  Accept</div>
    </div>
    <hr/>
    <?php endforeach ?>
 
  </div>
  <div class="card-footer text-center color3">
    show more
  </div>
   <?php }
        else{
  ?>
  <div class="card-footer text-center">
    Nothing to show!
  </div>
  <?php } ?>
</div>
    </div>
  </div>
</div>
<script src='assets/js/dashboard.js'></script>
<script type="text/javascript">
  function alertremove(){
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
  }, 4000);
}

  
  //Infinte Scroll on feed page
  var feedshow=true; //stop ajax request when last post arrived
   var loaded=false;
  $(window).on('scroll', function(){
      if($(window).scrollTop()+3 >= $('#post-data').offset().top + $('#post-data').outerHeight() - window.innerHeight) {
        console.log($('#post-data').offset().top + $('#post-data').outerHeight() - window.innerHeight);
        if(!loaded){
            var last_id = $(".post-id:last").attr("id");
            loaded = true; // Stop it from repeating itself
            loadMoreData(last_id);
        }
      }
   }); 

 //Commenting on a post


            function comment(ele) {
                 $commentbox=$(ele).parent().parent().find("input[type=text]");
                 ///console.log($commentVal);
                 $commentVal = $commentbox.val();
                 $postidVal=$(ele).parent().parent().find("input[type=hidden]").attr('placeholder');
                $.ajax({
                    url: "ajax/add_comments.php",
                    data: 'postid='+$postidVal+'&commentVal='+$commentVal,
                    type: 'post',
                    success: function (response)
                    {
                        var result = eval('(' + response + ')');
                       
                        if (response)
                        {
                          alert("comment Added!");
                          $commentbox.val("");
                          
                         //listComment();
                        } else
                        {
                            alert("Failed to add comments !");
                            return false;
                        }
                    }
                });
                
            }
 
 $('#OpenImgUpload').click(function(){ $('#sortpicture').trigger('click'); });

  $('#upload').on('click', function() {
    //alert("clicked");
    var msg_data=$("#posttxt").val();
    var file=$('#sortpicture').val();
    var file_data = $('#sortpicture').prop('files')[0]; 

    var form_data = new FormData();                  
    form_data.append('file', file_data);
    form_data.append('msg', msg_data);
    //console.log(filedata);
    if(file == '' && msg_data ==''){
      $('#feedpost').append('<div class="alert alert-danger" style="margin:5px" role="alert"><i class="fa fa-info-circle" aria-hidden="true"></i> Can\'t upload a Blank Post</div>');
      alertremove();
      return false;
    }
    else{
      $('#feedpost').append('<div class="alert"><div class="progress"><div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="75" aria-valuemin="0"aria-valuemax="100" style="width: 100%"></div></div></div>');
      alertremove();
     $.ajax({
        url: 'ajax/fileupload.php', // point to server-side PHP script 
        dataType: 'text',  // what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        type: 'post',
        data: form_data,                         
        success: function(php_script_response){
            $('#feedpost').append('<div class="alert alert-success" role="alert"><i class="fa fa-check" aria-hidden="true"></i>'+php_script_response+'</div>');
        alertremove();
        }
     });
    }
   $("#posttxt").val(''); 
   $("#sortpicture").val('');
   $("#imgpreview").empty();
});

 $(document).ready(function() {
  $( ".navbar-nav li:nth-child(1)" ).addClass('active');
});
</script>