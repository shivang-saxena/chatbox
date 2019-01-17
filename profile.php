<?php require('include/common.php') ?>
<?if(empty($_GET['p'])){
error("Sorry Page Not found");
exit();
}?>
<?php require('dashboard.code.php') ?>
<?php require_once( ROOT_PATH . '/include/headsection.php') ?>
<title>Profile-</title>

<?php
$id = $_GET['p'];
$db = new db();
        $result = $db->select("SELECT * FROM users WHERE user_id='$id'");
        if(!$result){
        error("Unable to fetch data from database");
         exit();   
        }
        ?>
</head>
<body class="colorbg4">
<?php include(ROOT_PATH."/include/navbar.php");?>
<?php
$feedobj=new MyFeed();
  $feedarray=$feedobj->getuserfeed($id);

$getfriends=new MyNetwork();
$friendarray=$getfriends->getFriendList($id);
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-sm-12">
           <div class="card profile-card-4 text-center">
                    <div class="card-img-block">
                        <img class="img-fluid" src="assets/images/userbg.png" alt="Card image cap">
                    </div>
                    <div class="card-body pt-5">
                        <img src="<?php echo $result[0]['picpath'];?>" alt="profile-image" class="profile"/>
                        <h5 class="card-title"><?php echo $result[0]['name'];?></h5>
                         <?php if($result[0]['gender'] == 'Male') {?>
                         <i class="fa fa-male" aria-hidden="true"></i>
                         <?php }else {?>
                         <i class="fa fa-female" aria-hidden="true"></i>
                     <?php }?>
                       <small class="text-muted"><?php echo $result[0]['gender'];?></small>
                        <hr>
                            <p>
                                <?php echo $result[0]['about'];?>
                            </p>
                           <div class="flex-row-center">
                               <div class="btn" style="border-right: 2px solid grey"><b><?php echo count($friendarray);?></b> Friends</div>
                               <div class="btn"><b><?php echo count($feedarray);?></b> Posts</div>
                           </div>
                           <hr>
                           <?php 
                           if($id == USERID){
                           $btn_value='editprofile';
                           
                           ?>
                           <div class="btn connect"  data-toggle="modal" data-target=".bd-example-modal-lg"><?php echo $btn_value?></div>

                          <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                          <div class="modal-dialog modal-lg">
                          <div class="modal-content">

                          <div class="modal-header">
                          <h4 class="modal-title" id="myLargeModalLabel">Edit Profile</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">×</span>
                          </button>
                          </div>
                          <div class="modal-body">
                          <form id="editprofileForm">
                            <div id="profilemsg"></div>
                           <div id="profileimgpreview"><img src="<?php echo $result[0]['picpath'];?>" alt="profile-image" class="profile" style="position: static" /></div>
                          
                         <button type="button" class="btn btn-secondary" id="OpenPImgUpload"><i class="fa fa-camera" aria-hidden="true"></i>
                        </button>
                         <input type="file" id="upldProfilepic" name="upldProfilepic" style="display: none;"/> 
                         <div class="form-group row">
                          <label for="inputAbout3" class="col-sm-2 col-form-label">About:</label>
                          <div class="col-sm-10">
                          <input type="text" class="form-control" name="inputAbout3" placeholder="About" value="<?php echo $result[0]['about'];?>"  required="">
                          </div>
                         </div>
                         <div class="form-group row">
                          <label for="inputName3" class="col-sm-2 col-form-label">Name:</label>
                          <div class="col-sm-10">
                          <input type="text" class="form-control" name="inputName3" placeholder="Name" value="<?php echo $result[0]['name'];?>" pattern="[A-Za-z].{3,}" title="Three Letter Name" required="">
                          </div>
                         </div>
                          <div class="form-group row">
                          <label for="inputEmail3" class="col-sm-2 col-form-label">Email:</label>
                          <div class="col-sm-10">
                          <input type="email" class="form-control" name="inputEmail3" placeholder="Email" value="<?php echo $result[0]['email'];?>"  required="">
                          </div>
                         </div>
                         <div class="form-group row">
                          <label for="inputUsername3" class="col-sm-2 col-form-label">Username:</label>
                          <div class="col-sm-10">
                          <input type="text" class="form-control" name="inputUsername3" placeholder="Username" value="<?php echo $result[0]['username'];?>" pattern=".{4,}" required="" title="usrname must be 4 character">
                          </div>
                         </div>
                         <div class="form-group row">
                          <label for="inputMobile3" class="col-sm-2 col-form-label">Mobile:</label>
                          <div class="col-sm-10">
                          <input type="text" class="form-control" name="inputMobile3" placeholder="Mobile" value="<?php echo $result[0]['mobile'];?>">
                          </div>
                         </div>
                         <div class="form-group row">
                          <label for="inputName3" class="col-sm-2 col-form-label">City:</label>
                          <div class="col-sm-10">
                          <select class="custom-select" name="inputSelect3">
                          <option selected><?php echo $result[0]['city'];?></option>
                          <option value="Bhopal">Bhopal</option>
              <option value="Delhi">Delhi</option>
              <option value="Indore">Indore</option>
              <option value="Jhansi">Jhansi</option>
              <option value="Kolkata">Kolkata</option>
              <option value="Lucknow">Lucknow</option>
              <option value="Mumbai">Mumbai</option>
              <option value="Pune">Pune</option>
                          </select>
                          </div>
                         </div>
                        
                        <button type="submit" class="btn btn-primary" id="btnUpdate">Update</button>
                          </form>

                          </div>
                          </div>
                          </div>
                          </div>


                           <?php }
                           else{
                           $btn_value='connect';
                           if($res=$getfriends->rqstPendingStatus($id)){
                           if($res[0]['status'] =='1'){
                           $btn_value='message';
                           }
                           if($res[0]['status'] =='0'){
                           $btn_value='pending';
                           }
                         } ?>
                          <div class="btn connect"><?php echo $btn_value?></div>
                       <?php }
                           ?>
                    </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <span class="font-weight-bold">About</span>
                </div>
                
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item"><span style="margin-right: 2rem;"><i class="fa fa-map-marker" aria-hidden="true"></i></span>Live in <a href="#"><?php echo $result[0]['city'];?></a></li>
                     <li class="list-group-item"><span style="margin-right: 2rem;"><i class="fa fa-facebook" aria-hidden="true"></i></span><a href="#">Facebook</a></li>
                     <li class="list-group-item"><span style="margin-right: 2rem;"><i class="fa fa-instagram" aria-hidden="true"></i></span><a href="#">Instagram</a></li>
                     <li class="list-group-item"><span style="margin-right: 2rem;"><i class="fa fa-calendar" aria-hidden="true"></i></span>Joined <span class="font-weight-bold"><?php echo $result[0]['time'];?></span></li>
                     </ul>
               
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <ul class="nav nav-tabs" role="tablist" style="margin-bottom: 3rem">
    <li class="nav-item">
    <a class="nav-link active" href="#posts" role="tab" data-toggle="tab">Posts</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#friends" role="tab" data-toggle="tab">Friends</a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="#cretive" role="tab" data-toggle="tab">Likes</a>
    </li>
    </ul>
    <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="posts">
  <?php foreach ($feedarray as $post): ?>
<div class="card">
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

 <!--  <div class="collapse" id="collapseComments-<?php echo $post['id']?>">
    <div class="card card-body">
  <form class="form-inline">
  <div class="form-group mx-sm-3 mb-2">
    <textarea></textarea>
  </div>
  <button type="button" class="btn btn-info" id="comment">POST</button>
</form>
</div>
</div> -->
   </div>

</div>
<?php endforeach ?>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="friends">
      <?php
       //print_r($friendarray);
      $db = new db();
      foreach ($friendarray as $value) {?>
       <div class="card card-body flex-column">
                <div class="flex-row-space">
                   <img src="<?php echo $value['picpath'];?>" width="50" height="50" class="d-inline-block align-left" alt="" style="border-radius: 50%">
                <div class="flex-column">
                <a href="#"><span><b><?php echo $value['name'];?></b></span></a>
               <small class="text-muted"><?php echo $value['city'];?></small>
                </div>
                <?php 
                $btn_value='connect';
                if($getfriends->checkingFriendship($value['user_id'])){
                  $btn_value='message';
                }
                if($value['user_id'] == USERID){
                 $btn_value='ME'; 
                }
                ?>
                <div class="btn connect" onclick="addAsFriend(<?php echo $value['user_id']; ?>,'<?php echo $btn_value;?>',this);"><?php echo $btn_value;?></div>
               </div>
              </div>
      <?php
      }?>
    </div>
    <div role="tabpanel" class="tab-pane fade" id="cretive">
        <div class="jumotron">
            <h2>Likes section Coming Soon..........</h2>
        </div>
    </div>
    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
          <div class="card">
               <div class="card-header">
                  <span class="font-weight-bold">People's you may know</span> 
               </div>
                <div class="card-body flex-column">
                  <?php foreach ($getfriends->cardDisplayUsers() as $value2):?>
                <div class="flex-row border-bottom">
                   <img src="<?php echo $value2['picpath'];?>" width="50" height="50" class="d-inline-block align-left" alt="" style="border-radius: 50%">
                <div class="flex-column">
                <a href="<?php echo 'profile.php?p='.$value2['user_id']; ?>"><span><b><?php echo $value2['name'];?></b></span></a>
               <small class="text-muted"><?php echo $value2['city'];?></small>
               <?php 
                           $btn_value='connect';
                           if($res=$getfriends->rqstPendingStatus($value2['user_id'])){
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
<script type="text/javascript">
  $('#OpenPImgUpload').click(function(){ $('#upldProfilepic').trigger('click'); });
  $("#btnUpdate").click(function(){
    var form=$("#editprofileForm").serialize();

    $.ajax({
         url: 'ajax/editprofile.php',
      
        cache: false,
        type: 'post',
        data: form,
        success: function(response){

         $('#profilemsg').html('<b style="color:green">'+response+'</b>')

        }

      });
    return false;
  });
</script>
</body>
</html>
