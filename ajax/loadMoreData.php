<?php require('../dashboard.code.php') ?>
  <?php
  $lastid=$_GET['last_id'];
  //$lastid=1;
  $feedobj=new MyFeed();
  //$feedarray=$feedobj->getFeed();
   $db = new db();
  $query="SELECT t1.*,t2.user_id,t2.name,t2.picpath,t2.city FROM posts t1,users t2 WHERE t1.user_id=t2.user_id AND t1.id < '$lastid' AND t1.status='1' ORDER BY t1.id DESC LIMIT 3";
  $feedarray = $db->select($query);

  $json = include('post_data.php');
  //echo json_encode($json);
  ?>
  