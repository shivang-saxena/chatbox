<?php require('include/common.php') ?>
<?php require('dashboard.code.php') ?>
<?php require_once( ROOT_PATH . '/include/headsection.php') ?>
      <title>ChatBox</title>
  <head>
  <body class="colorbg4">
  <?php include(ROOT_PATH."/include/navbar.php");?>

<?php
  $pages_dir='chat_pages';
  if(!empty($_GET['p'])){
    $pages= scandir($pages_dir,0);
    unset($pages[0],$pages[1]);
    

    $p=$_GET['p'];

    if(in_array($p.'.inc.php',$pages)){
      include($pages_dir.'/'.$p.'.inc.php');
    }
    else{
      error("Sorry Page Not found");
    }
  }
  else{
    include($pages_dir.'/feed.inc.php');
  }
  ?>
  </body>
</html>