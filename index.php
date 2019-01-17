<!DOCTYPE html>
<html >
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/images/logo.png">

    <title>ChatBox-Bringing People Closer Together</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <!-- FONT AWESOME  CSS -->
<link href="assets/css/font-awesome.css" rel="stylesheet" />
<script>
try{
Typekit.load({
 async: true 
});
}
catch(e){}
</script>
<!-- CUSTOM STYLE CSS -->
    <link href="assets/css/index.css" rel="stylesheet" />
   
    <style type="text/css">
    	::-webkit-scrollbar {
    width: 3px;
}

/* Track */
::-webkit-scrollbar-track {
    background: #f1f1f1; 
}
 
/* Handle */
::-webkit-scrollbar-thumb {
    background: #888; 
}

/* Handle on hover */
::-webkit-scrollbar-thumb:hover {
    background: #555; 
    </style>

</head>

<body>
  
  <header>
	<div class="container">
  		<nav>
      <span class="chat">CHAT</span>
      <span class="box">B</span>
      <div class="logo" >
        <img src="assets/images/logo.png" class="img-responsive">

      </div>

      <span class="box">X</span>
      <div class="subscribe">
        <a href="#" id="myBtn">Login</a>
      </div>
      
		</nav>
		<blockquote>Make a real time connection with Strangers.Build stronger relationships
		<span>&mdash; ChatBOX is a simply social media platform.</span>
		</blockquote>
		<div class="date text-center">
			<i class="fa fa-calendar" aria-hidden="true" id="header-date"></i> 
			
		</div>
	</div>

</header>



<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="js-title-step"></h4>
      </div>
      <div class="modal-body">
  <div class="row hide" data-step="1" data-title="This is the first step!">
    <div class="jumbotron">This is the first step!</div>
  </div>
  <div class="row hide" data-step="2" data-title="This is the second step!">
    <div class="jumbotron">This is the second step!</div>
  </div>
  <div class="row hide" data-step="3" data-title="This is the last step!">
    <div class="jumbotron">This is the last step!</div>
  </div>
</div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default js-btn-step pull-left" data-orientation="cancel" data-dismiss="modal"></button>
    <button type="button" class="btn btn-warning js-btn-step" data-orientation="previous"></button>
    <button type="button" class="btn btn-success js-btn-step" data-orientation="next"></button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content" >
        <div class="modal-header" style="border-top-left-radius: 0;border-top-right-radius:0 ">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4>Login</h4>
        </div>

        <div class="modal-body">
          <div id="login-form">
            <div class="social-login" style="text-align: center;">
               <a url="" title="Facebook" class="btn btn-social" minimal="true" style="background: #3a5795;">
        <i class="fa fa-facebook"></i> <span>Facebook</span></a>
        <!-- <a url="" title="Github" class="btn btn-social" minimal="true" style="background: #444;"><i class="fa fa-github"></i> <span >Github</span></a> -->
       <a url="" title="Google" class="btn btn-social" minimal="true" style="background: #dd4b39;;"><i class="fa fa-google-plus"></i> <span >Google</span></a>
            </div>
           <div class="standard-margin">
          <div class="word-with-line">
          <span style="color: #9ca3a8;font-size: 16px;">or</span>
         </div>
         </div>

          <form onsubmit="return submitlogindata();">
            <div class="alert-box"></div>
            <div class="form-group">
              <input type="text" class="form-control" id="usrname" name="txtemail" placeholder="Enter username or email"  required="">
            </div>

            <div class="form-group">
              <input type="password" class="form-control" id="psw" name="txtpass" placeholder="Enter password"   required="">
            </div>
            <div style="height: 20px;"><a href="#" style="text-decoration: none;font-size: 13px;float: right" >Forgot Password?</a></div>
            <div class="alert alert-danger" id="errmsg" style="display: none;">
           </div>
            <div class="checkbox">
            </div>
            
            <div class="modal-button" style="text-align: center;">
              <button  href="#" class="subscribe" id="submitlogin" name="submitlogin" clicked="Logging In..">
              <span class="glyphicon glyphicon-off"></span> Login</button>
            </div>
             </form>
             
            <div style="margin: 30px 0 0 0;font-size: 14px;text-align: center;display: block;"><span>Don't have an account?<a href="#" style="text-decoration: none;" onclick="openCity()">Sign up</a></span></div>
            </div>
            <!-- End Login Form -->


           <div class="tabcontent" id="signup-form">
            
          <form id="register-form" onsubmit="return submitdata();">
            <div class="alert-box">
              
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="txtname" name="txtname" placeholder="Your Name" pattern="[A-Za-z].{3,}" title="Three Letter Name" required="">
          </div>
            <div class="form-group">
              <label class="form-control" ><input type="radio" name="gender" value="Male" checked>Male
               <input type="radio" name="gender" value="Female">Female</label>
            </div>
            <div class="form-group">
              <input type="text" class="form-control" id="txtuser" name="txtuser" placeholder="Username" pattern=".{4,}" required="" title="usrname must be 4 character">
            </div>
            <div class="form-group">
              <input type="password" class="form-control" id="txtpass" name="txtpass" placeholder="Password" pattern=".{4,}"required="" title="minimum length : 4">
            </div>
            <div class="form-group">
              <input type="email" class="form-control" id="txtemail" name="txtemail" placeholder="Email" required="">
            </div>
            <div class="form-group">
              <select name="city" class="form-control">
              <option value="">City</option>
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
             <div class="modal-button" style="text-align: center;">
              <button  href="#" class="btn" id="submitregister" name="submitregister">
              <span class="glyphicon glyphicon-off"></span> Register</button>
            </div>
             </form>
            <div style="margin: 30px 0 0 0;font-size: 14px;text-align: center;display: block;"><span>Have an account?<a href="#" style="text-decoration: none;" onclick="openCity()">Login</a></span></div>
            </div>
            <!-- END Signup Form -->

        </div>
      </div>
      
    </div>
  </div>  <!--Modal End-->
</body>

<script src='assets/js/jquery-3.3.1.js'></script>
<script src='assets/js/modal-steps.min.js'></script>
<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script type="text/javascript">
  $('#myModal2').modalSteps();
</script>
    <script>
     function openCity() {
      if($(".modal-header h4").text()[0] == "L")
      $(".modal-header h4").text("Sign Up");
    else
      $(".modal-header h4").text("Login");

     $("#login-form").toggleClass("tabcontent");
     $("#signup-form").toggleClass("tabcontent");
     invalid_message("");
}

    $(document).ready(function(){
    	var timeobj = new Date();
      var time=timeobj.toLocaleString('en-US', { month: 'numeric', day: 'numeric',year: 'numeric' });
      $("#header-date").html("     "+time);
    $("#myBtn").click(function(){
        $("#myModal").modal();
    });
   
});
    function submitlogindata()
    {
             var clientmsg=$("#usrname").val()+"|"+$("#psw").val();
            $("#submitlogin").text("Logging In...");
                $.ajax({
                url:'ajax/form.php',
                cache  :false,
                type:'post',
                data:{login:clientmsg},
                success: function(data) {
                  if(data.trim() ==='success'){
                    window.location.href='dashboard.php';
                   }
                   else{
                  invalid_message('<span style="color:red;">'+data+'</span>');
                  $("#submitlogin").text("Login");
                    }
                  },
                    error: function(xhr, status, error) {
                    alert(status);
                    }
                });

           return false;
    }

    function submitdata() {
            var formdata = $("#register-form").serializeArray();
          var data = {};
          $(formdata ).each(function(index, obj){
           data[obj.name] = obj.value;
           });
          //console.log(data);
            $.ajax({
                url:'ajax/form.php',
                cache  :false,
                type:'post',
                data:{register:JSON.stringify(data)},
                success: function(data) {
                  $("#register-form")[0].reset();
                   invalid_message('<span style="color:green;">'+data+'</span>');
                   },
                error: function(xhr, status, error) {
                 alert(status);
                 //return false;
                }
            });

      return false;
      }

    function invalid_message(msg){
      $(".alert-box").html(msg);
    }
    </script>

</html>
