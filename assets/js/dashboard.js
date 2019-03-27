var click_id,click_name,clik_src;
var current_user_name,current_user_id,current_user_src;
var c_id;
current_user_name=$("#loggeduser").attr('name');
current_user_id=$("#loggeduser").attr('value'); 
current_user_src=$("#loggeduser").attr('src');
 
//alertremove
function alertremove(){
  window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function(){
        $(this).remove(); 
    });
  }, 4000);
}

//Smooth Scroll{
window.smoothScroll = function(target) {
  var scrollContainer = target;
  do { //find scroll container
      scrollContainer = scrollContainer.parentNode;
      if (!scrollContainer) return;
      scrollContainer.scrollTop += 1;
  } while (scrollContainer.scrollTop == 0);

  var targetY = 0;
  do { //find the top of target relatively to the container
      if (target == scrollContainer) break;
      targetY += target.offsetTop;
  } while (target = target.offsetParent);

  scroll = function(c, a, b, i) {
      i++; if (i > 30) return;
      c.scrollTop = a + (b - a) / 30 * i;
      setTimeout(function(){ scroll(c, a, b, i); }, 20);
  }
  // start scrolling
  scroll(scrollContainer, scrollContainer.scrollTop, targetY, 0);
}

//display image preview
if (window.File && window.FileList && window.FileReader) {
  $("#sortpicture").on("change", function(e) {
    var files = e.target.files,
      filesLength = files.length;
    for (var i = 0; i < filesLength; i++) {
      var f = files[i]
      var fileReader = new FileReader();
      fileReader.onload = (function(e) {
        var file = e.target;
        $("#imgpreview").html("<img class=\"img-thumbnail\" height=\"200\" width=\"200\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
          "<i class=\"fa fa-times-circle imgpreview_rm\" aria-hidden=\"true\"> </i>");
        $(".imgpreview_rm").click(function(){
          $("#sortpicture").val('');
          $(this).parent("span").empty();
        });
      });
      fileReader.readAsDataURL(f);
    }
    console.log(files[0]['name']);
  });

  $("#upldProfilepic").on("change", function(e) {
    var files = e.target.files,
      filesLength = files.length;
    for (var i = 0; i < filesLength; i++) {
      var f = files[i]
      var fileReader = new FileReader();
      fileReader.onload = (function(e) {
        var file = e.target;
        $("#profileimgpreview").html("<img class=\"profile\" src=\"" + e.target.result + "\" title=\"" + file.name + "\" style=\"position: static\"/>");
      });
      fileReader.readAsDataURL(f);
    }
    console.log(files[0]['name']);
  });
} else {
  alert("Your browser doesn't support to File API")
}

//load the data from show more
function loadMoreData(last_id){
      loaded = false; // Stop it from repeating itself
      if(feedshow){
        loaded = true;
    $.ajax(

          {

              url: 'ajax/loadMoreData.php?last_id=' + last_id,

              type: "get",

              beforeSend: function()

              {

                  $('.ajax-load').show();

              }

          })

          .done(function(data)

          {
              $('.ajax-load').hide();
              if(data.trim() != 'nodata'){
              $("#post-data").append(data);
              }
              else
              {
              $("#post-data").append('<div class="card-footer text-center">End of Feed</div>');
              feedshow=false;
              }
              loaded = false; // Stop it from repeating itself

          })

          .fail(function(jqXHR, ajaxOptions, thrownError)

          {

                alert('Loading...');
              loaded = true;

          }); 
  }
  }

//this function send a request, redirect to message and edit profile section
function addAsFriend($id,$action,obj){
  if($action =='connect'){
  $(obj).html('<i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
  var status=0;
  var user_one_id=current_user_id < $id ? current_user_id : $id ;
  var user_two_id=current_user_id > $id ? current_user_id : $id ;
  var senddata={"user_one_id":user_one_id,"user_two_id":user_two_id,"status":status,"action_user_id":current_user_id};
  var postdata=JSON.stringify(senddata);
  $.ajax({
          url:'ajax/conversion.php',
          type:'post',
          data:{request:postdata},
          success:function(html){
            $('.AlertFixed').toggle();
           $('.AlertFixed').text(html);
           alertremove();
          }
      });
  $(obj).parent().parent().fadeOut( 6000 ).remove();
}
 if($action =='message'){
  window.location.href='dashboard.php?p=messaging'
 }
 if($action =='editprofile'){
  alert('edit profile Section');
 }
}



function addLikes(id,action,userid) {
$('#post-'+id+' .like').html('<div class="btn btn-unlike" title="unlike"><i class="fa fa-spinner fa-spin" aria-hidden="true"></i>  '+action+'</div>');
$.ajax({
        url:'ajax/add_likes.php',
        type:'post',
        data:'id='+id+'&action='+action+'&userid='+userid,
        success:function(html){
        var likes = parseInt($('#likes-'+id).val());
        switch(action) {
        case "like":
        $('#post-'+id+' .like').html('<div class="btn btn-unlike" title="unlike" onclick="addLikes('+id+',\'unlike\','+userid+')"><i class="fa fa-thumbs-up" aria-hidden="true"></i>  unlike</div>');
        likes = likes+1;
        break;
        case "unlike":
        $('#post-'+id+' .like').html('<div class="btn btn-like" title="like" onclick="addLikes('+id+',\'like\','+userid+')"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i>  like</div>')
        likes = likes-1;
        break;
        }
$('#likes-'+id).val(likes);
if(likes>0) {
  $('#post-'+id+' .label-likes').html(likes+" Like(s)");
} else {
  $('#post-'+id+' .label-likes').html('0 Like');
}
}
});
}


//ADD Comments on a post
function listComment() {
              $.post("comment-list.php",
                      function (data) {
                             var data = JSON.parse(data);
                          
                          var comments = "";
                          var replies = "";
                          var item = "";
                          var parent = -1;
                          var results = new Array();

                          var list = $("<ul class='outer-comment'>");
                          var item = $("<li>").html(comments);

                          for (var i = 0; (i < data.length); i++)
                          {
                              var commentId = data[i]['comment_id'];
                              parent = data[i]['parent_comment_id'];

                              if (parent == "0")
                              {
                                  comments = "<div class='comment-row'>"+
                                  "<div class='comment-info'><span class='commet-row-label'>from</span> <span class='posted-by'>" + data[i]['comment_sender_name'] + " </span> <span class='commet-row-label'>at</span> <span class='posted-at'>" + data[i]['date'] + "</span></div>" + 
                                  "<div class='comment-text'>" + data[i]['comment'] + "</div>"+
                                  "<div><a class='btn-reply' onClick='postReply(" + commentId + ")'>Reply</a></div>"+
                                  "</div>";

                                  var item = $("<li>").html(comments);
                                  list.append(item);
                                  var reply_list = $('<ul>');
                                  item.append(reply_list);
                                  listReplies(commentId, data, reply_list);
                              }
                          }
                          $("#output").html(list);
                      });
          }

          function listReplies(commentId, data, list) {
              for (var i = 0; (i < data.length); i++)
              {
                  if (commentId == data[i].parent_comment_id)
                  {
                      var comments = "<div class='comment-row'>"+
                      " <div class='comment-info'><span class='commet-row-label'>from</span> <span class='posted-by'>" + data[i]['comment_sender_name'] + " </span> <span class='commet-row-label'>at</span> <span class='posted-at'>" + data[i]['date'] + "</span></div>" + 
                      "<div class='comment-text'>" + data[i]['comment'] + "</div>"+
                      "<div><a class='btn-reply' onClick='postReply(" + data[i]['comment_id'] + ")'>Reply</a></div>"+
                      "</div>";
                      var item = $("<li>").html(comments);
                      var reply_list = $('<ul>');
                      list.append(item);
                      item.append(reply_list);
                      listReplies(data[i].comment_id, data, reply_list);
                  }
              }
          }

function requeststatus(senddata){
$.ajax({
          url:'ajax/conversion.php',
          type:'post',
          data:{rqststatus:senddata},
          success:function(html){
              alert(html);

          }
      });
}

function getnotification(){
$.ajax({
          url:'ajax/conversion.php',
          type:'post',
          data:{notification:"notification"},
          success:function(html){
            var str="";
           var obj=JSON.parse(html);
           var count=0;
                  //console.log(obj);
                  $.each(obj, function(i, item) {
                    count++;
                    if(item.status == 0)
                    str+='<div class="alert alert-dark" id="'+item.action_user_id+'" alt="'+item.picpath+'"><strong>'+item.name+'</strong> sent you a request <button type="button" class="btn btn-success" alt="accept">Accept</button><button type="button" class="btn btn-danger reject" alt="reject">Reject</button></div>';         
                    else
                    str+='<div class="alert alert-dark" id="'+item.action_user_id+'" alt="'+item.picpath+'"><strong>'+item.name+'</strong> Reject Your Request</div>';         
                   });
            $("#mdlbdynt").html(str);
            $("#notification").attr("data-badge",count);
          }
      });
}
function createchat(id){
var conversion="";
      $.ajax({
          url:'ajax/conversion.php',
          type:'post',
          data:{createchat:id},
          success:function(value){
              conversion=value;
          }
      });
      return conversion;
   }




function chatlog(c_id){
$.ajax({
              url:'ajax/conversion.php',
              cache  :false,
              type:'post',
              data:{chatlog:c_id},
              success: function(html) {
                  var obj=JSON.parse(html);
                  //console.log(html);
                  var str="";
                  $.each(obj, function(i, item) {
                    if(item.user_id != current_user_id){
                      str+='<li class="replies"><img src="'+clik_src+'" alt="" /><p><small>'+item.time+'</small><br/>'+item.reply+'</p></li>';
                      }
                      else
                      {
                      str+='<li class="sent"><img src="'+current_user_src+'" alt="" /><p><small>'+item.time+'</small><br/>'+item.reply+'</p></li>';
                      }          
                   });
                  $(".messages ul").html(str);
                  $(".messages").animate({scrollTop: $('.messages').get(0).scrollHeight}, 1000);
                  },
              error: function(xhr, status, error) {
               alert(status);
              }
          });
}


function newMessage() {
  message = $(".message-input input").val();
  if($.trim(message) == '') {
      return false;
  }
  $('<li class="sent"><img src="'+current_user_src+'" alt="" /><p>' + message + '</p><small id="sending">Sending</small></li>').appendTo($('.messages ul'));
var senddata={"reply":message,"c_id":c_id};
      var postdata=JSON.stringify(senddata);
      $.ajax({
          url:'ajax/conversion.php',
          type:'post',
          data:{msg_data:postdata},
          success:function(html){
            if(html == "Sent")
              $("#sending").remove();
            else
              $("#sending").text("Failed");
          }
      });
  $('.message-input input').val(null);
  $('.contact.active .preview').html('<span>You: </span>' + message);
  $(".messages").animate({scrollTop: $('.messages').get(0).scrollHeight}, 2000);
};
$('.submit').click(function() {
newMessage();
});

$(window).on('keydown', function(e) {
if (e.which == 13) {
  newMessage();
  chatlog(c_id);
  return false;
}
});

$(document).ready(function(){
  $(".contact-profile").hide();
  $(".message-input").hide();
 
 //show and hide search dialog box
  $( "#searchBox" ).focusin(function() {
  $("#searchDialog").slideToggle("slow");
  $('#searchBox').keyup(function(e){

    e.preventDefault();

    var form = $('#searchForm').serialize();
    $.ajax({

      type: 'POST',

      url: 'ajax/do_search.php',

      data: form,


      success: function(response){

        $("#searchDialog").html(response);

      }

    });

  });
 });
   $( "#searchBox" ).focusout(function() {
  $("#searchDialog").slideToggle("slow");
 });

//show notification panel
$( "#showNotification").click(function() {
  $("#notificationPanel").slideToggle( "slow" );
  $('.ajax-load').show();
  $.ajax({

      type: 'POST',

      url: 'ajax/notification.php',

      data: "form",


      success: function(response){
         $('.ajax-load').hide();
        $("#notificationPanel").html(response);

      }

    });
  
 });
 //   $( "#showNotification" ).click(function() {
 //  $("#notificationPnael").slideUp( 300 ).delay(1000).fadeOut();
 // });

//Get chat result of particular user clicked
$("#contacts").on("click","ul li",function(){
  $(".contact-profile").show();
  $(".message-input").show();
  $("#intialmsg").hide();
  click_id=$(this).attr("id");
  c_id=$(this).attr("name");
  click_name=$(this).find("img").attr("alt");
  clik_src=$(this).find("img").attr("src");
  $("#contacts ul li").removeClass("active");
  $(this).addClass("active");
  $(".contact-profile p").text(click_name);
  $(".contact-profile img").attr("src",clik_src);
 chatlog(c_id);
});



$(".messages").animate({ scrollTop: $(document).height() }, "fast");

$("#profile-img").click(function() {
  $("#status-options").toggleClass("active");
});

$(".expand-button").click(function() {
$("#profile").toggleClass("expanded");
  $("#contacts").toggleClass("expanded");
});

$("#status-options ul li").click(function() {
  $("#profile-img").removeClass();
  $("#status-online").removeClass("active");
  $("#status-away").removeClass("active");
  $("#status-busy").removeClass("active");
  $("#status-offline").removeClass("active");
  $(this).addClass("active");
  
  if($("#status-online").hasClass("active")) {
      $("#profile-img").addClass("online");
  } else if ($("#status-away").hasClass("active")) {
      $("#profile-img").addClass("away");
  } else if ($("#status-busy").hasClass("active")) {
      $("#profile-img").addClass("busy");
  } else if ($("#status-offline").hasClass("active")) {
      $("#profile-img").addClass("offline");
  } else {
      $("#profile-img").removeClass();
  };
  
  $("#status-options").removeClass("active");
});
});

//Autumatic take height and width when window is resized
function windowsize(){
$(window).height(); // New height // New width 
$("#frame").css("max-width",$(window).width());
$("#frame").css("height",$(window).height()-60);
}
$(window).resize(windowsize);
$(document).ready(windowsize);
