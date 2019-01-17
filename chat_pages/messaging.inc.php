<?php
$obj=new Messaging();
?>
    <div id="frame">
    <div id="sidepanel">
        <div id="profile">
            <div class="wrap">
                <img id="profile-img" src="<?php echo PICPATH?>" class="online" alt="" />
                <p id="<?php echo USERID?>"><?php echo USERNAME?></p>
        <i class="fa fa-chevron-down expand-button" aria-hidden="true"></i>
       <!--  <i class="fa fa-bell badge1"  data-badge="27" style="float: right;cursor: pointer;color:#435f7a;margin-top: 23px;
    margin-right: 23px;" aria-hidden="true" data-toggle="modal" data-target="#myNotification" id="notification"></i> -->
                <div id="status-options">
                    <ul>
                        <li id="status-online" class="active"><span class="status-circle"></span> <p>Online</p></li>
                        <li id="status-away"><span class="status-circle"></span> <p>Away</p></li>
                        <li id="status-busy"><span class="status-circle"></span> <p>Busy</p></li>
                        <li id="status-offline"><span class="status-circle"></span> <p>Offline</p></li>
                    </ul>
                </div>
                <div id="expanded">
                    <label for="twitter"><i class="fa fa-facebook fa-fw" aria-hidden="true"></i></label>
                    <input name="twitter" type="text" value="twitter" />
                    <label for="twitter"><i class="fa fa-twitter fa-fw" aria-hidden="true"></i></label>
                    <input name="twitter" type="text" value="twitter" />
                    <label for="twitter"><i class="fa fa-instagram fa-fw" aria-hidden="true"></i></label>
                    <input name="twitter" type="text" value="instagram" />
                </div>

            </div>
        </div>
        <div id="search">
            <label for=""><i class="fa fa-search" aria-hidden="true"></i></label>
            <input type="text" placeholder="Search contacts..." style="width: 100%;
             border-bottom: 1px dotted grey;" />
        </div>
     
     <!-- CONVERSION LISTS -->
        <div id="contacts">
            <ul>
                <?php
                $result=$obj->getConversion();
                
                foreach ($result as $value) {
                print_r('<li class="contact" id="'.$value['user_id'].'" name="'.$value['c_id'].'"><div class="wrap"><span class="contact-status online"></span><img src="'.$value['picpath'].'" alt="'.$value['name'].'" /><div class="meta"><p class="name">'.$value['name'].'</p><p class="preview">'.$value['reply'].'</p></div></div></li>');
                }
                ?>
            </ul>
        </div>

    </div>

    <div class="content">
        <div class="contact-profile">
            <img src="" alt="" />
            <p></p>
            <div class="social-media">
                <i class="fa fa-facebook" aria-hidden="true"></i>
                <i class="fa fa-twitter" aria-hidden="true"></i>
                 <i class="fa fa-instagram" aria-hidden="true"></i>
            </div>
        </div>
        <div class="messages" style="width: 100%">
            <div id="intialmsg" class="jumbotron jumbotron-fluid">
            <div class="container">
            <h1>welcome to <br><b style="font-size: 10vw">CHATBOX</b></h1> 
            </div>
           </div>
            <ul>
                    
            </ul>
        </div>
        <div class="message-input">
            <div class="wrap">
            <input type="text" placeholder="Write your message..." />
            <i class="fa fa-paperclip attachment" aria-hidden="true"></i>
            <button class="submit"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
            </div>
        </div>
    </div>
</div>

<!-- ADD CONTACT LIST -->
<div id="myNav" class="overlay">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <div class="overlay-content">
<!-- Team -->
<section id="users" class="pb-5">
    <div class="container">
        <h5 class="section-title h1">ADD CONTACTS</h5>
        <div class="row">
            
        </div>
    </div>
</section>
<!-- Team -->

  </div> <!-- /overlay-content -->
</div>



         
        
      </div>
    </div>
  </div>
</div>
<script src='assets/js/dashboard.js'></script>
<script type="text/javascript">
    $( ".navbar-nav li:nth-child(3)" ).addClass('active');
</script>