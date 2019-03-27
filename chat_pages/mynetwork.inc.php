<?php
$obj=new MyNetwork();
?>
<div class="container-fluid network">
<div class="row">
	<div class="col-md-3">
	<div class="card text-center">
  <div class="card-body">
    <a href="<?php echo 'profile.php?p='.USERID; ?>"><h5 class="card-title"><?php echo count($obj->getFriendList(USERID))?></h5></a>
    <h6 class="card-subtitle mb-2 text-muted">Connection</h6>
    
  </div>
</div>	
	</div>

	<div class="col-md-6">
		 <div class="card">
  <div class="card-header text-center color3">
        <?php 
        
        $rqstarray=$obj->getInvitations();
        print_r("INVITATIONS");
        
        ?>
  </div>
  <?php  if($rqstarray){ ?>
  <div class="card-body" id="invitations">
   
      <?php foreach($rqstarray as $value): ?>
     <div class="row">
      <div class="col-md-6">
       <div class="flex-row">
        <img src="<?php echo $value[0]['picpath']; ?>" width="70" height="70" class="d-inline-block align-left" alt="" style="border-radius: 50%">
        <div class="flex-column">
        <a href="<?php echo 'profile.php?p='.$value[0]['user_id']; ?>"><span><b><?php echo $value[0]['name']; ?></b></span></a>
       <small class="text-muted"><?php echo $value[0]['city']; ?></small>
       <!-- <small class="text-muted"><?php echo $value[0]['city']; ?></small> -->
       </div>
        </div>
      </div>
      <div class="col-md-6">
         <div class="flex-row" value="<?php echo $value[0]['user_id']?>">
         <div class="ignore btn">
         <i class="fa fa-thumbs-o-down" aria-hidden="true"></i>  Ignore</div>
         <div class="accept btn">
         <i class="fa fa-thumbs-o-up" aria-hidden="true"></i>  Accept</div>
         </div>
      </div>
  </div>
  <hr>
  <?php endforeach ?>
     </div>
     <div class="card-footer text-center color3">
      show more
    </div>  
  <?php } else { ?>
    <div class="card-footer text-center text-muted color3">
      No Invitatins!
    </div>  
  <?php } ?>
  </div>
    
  <div class="card" style="margin-top: 20px;">
    <div class="card-header text-center color3">
      <b>PEOPLE'S YOU MAY KNOW</b>
    </div>
    <div class="card-body">
      <div class="row">
        <?php foreach ($obj->displayUsers() as $value2):?>
      <a href="#"><div class="col-md-4 listcontact">
        <div class="flex-column-space" value="<?php echo $value2['user_id']; ?>">
           <img src="<?php echo $value2['picpath']; ?>" width="70" height="70" class="" alt="" style="border-radius: 50%">
            <a href="<?php echo 'profile.php?p='.$value2['user_id']; ?>"><span><b><?php echo $value2['name']; ?></b></span></a>
            <small class="text-muted"><?php echo $value2['city']; ?></small>
                          <?php 
                           $btn_value='connect';
                           if($res=$obj->rqstPendingStatus($value2['user_id'])){
                           if($res[0]['status'] =='1'){
                           $btn_value='message';
                           }
                           if($res[0]['status'] =='0'){
                           $btn_value='pending';
                           }
                         }
                           ?>
            <div class="btn connect" onclick="addAsFriend(<?php echo $value2['user_id']; ?>,'<?php echo $btn_value;?>',this);"><?php echo $btn_value;?></div>
        </div>
        <hr>
      </div></a>
      <?php endforeach ?>
    </div>
    </div>
    <div class="card-footer text-center color3">
      show more
    </div>
  </div>
</div>
 

<div class="col-md-3">
		 <div class="card">
                <div class="card-header">
                    <span class="font-weight-bold"><i class="fa fa-hashtag" aria-hidden="true"></i>Trending Hashtags</span>
                </div>
                <?php $feedobj=new MyFeed(); ?>
                <?php $hashtags = $feedobj->getTrendingHashtags(); ?>
                   <ul class="list-group list-group-flush text-center">
                   <?php foreach ($hashtags as $hashtag): ?>
                   <li class="list-group-item"><a href="hashtag.php?tag='<?php print_r(ltrim($hashtag['hashtag'], '#'));?>'"><?php print_r($hashtag['hashtag']); ?></a></li>
                     
                   <?php endforeach ?>
                     </ul>
               
      </div>
  
	</div>
</div>
</div>
<script src='assets/js/dashboard.js'></script>
<script type="text/javascript">
  // var current_user_id=$("#loggeduser").attr('value');
  // var current_user_name=$("#loggeduser").attr('name');
  // var current_user_src=$("#loggeduser").attr('src');
  $( ".navbar-nav li:nth-child(2)" ).addClass('active');
  function fixedalert(value){
   $("body").html('<div class=\"alert alert-success\" style=\"position: fixed;bottom: 0;left:0;\"><strong>Success!</strong> You should <a href="#" class=\"alert-link\">'+value+'</a></div>');
  }

  $('.accept').on('click', function() {
    var status=1;
    var id=$(this).parent().attr('value');
    var user_one_id=current_user_id < id ? current_user_id : id ;
    var user_two_id=current_user_id > id ? current_user_id : id ;
    var senddata={"user_one_id":user_one_id,"user_two_id":user_two_id,"status":status,"action_user_id":current_user_id};
    var postdata=JSON.stringify(senddata);
    $.ajax({
            url:'ajax/conversion.php',
            type:'post',
            data:{rqststatus:postdata},
            success:function(html){
              $('.AlertFixed').toggle();
           $('.AlertFixed').text(html);
           alertremove();
            }
        });
    createchat(id);
    $(this).parent().parent().parent().remove(); 
  }); 
  $('.ignore').on('click', function() {
    var status=2;
    var id=$(this).parent().attr('value');
    var user_one_id=current_user_id < id ? current_user_id : id ;
    var user_two_id=current_user_id > id ? current_user_id : id ;
    var senddata={"user_one_id":user_one_id,"user_two_id":user_two_id,"status":status,"action_user_id":current_user_id};
    var postdata=JSON.stringify(senddata);
    $.ajax({
            url:'ajax/conversion.php',
            type:'post',
            data:{rqststatus:postdata},
            success:function(html){
              alert(html);
            }
        });
    $(this).parent().parent().parent().remove(); 
  });

  
</script>