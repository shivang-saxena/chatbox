<?php require('../dashboard.code.php') ?>
<?php
if(isset($_POST['searchBox']) && strlen($_POST['searchBox'])>2){

		$querystr = $_POST['searchBox'];

 

		if(empty($querystr)){

			//$results['error'] = true;

		}else{
			 $db = new db();

			$sql = "SELECT user_id,name,city,picpath FROM users WHERE name LIKE '%$querystr%'";
			 $sqlquery = $db->select($sql);

 

			if($sqlquery){

				 foreach ($sqlquery as $post)
                   {
					
					?>
					<div class="card-body flex-column">
              <div class="flex-row border-bottom">
                   <img src="<?php echo $post['picpath']?>" width="50" height="50" class="d-inline-block align-left" alt="" style="border-radius: 50%">
              <div class="flex-column">
                <a href="<?php echo 'profile.php?p='.$post['user_id']?>"><span><b><?php echo $post['name']?></b></span></a>
               <small class="text-muted"><?php echo $post['city']?></small>
              </div>
              </div>
               </div>
				<?}

				}

			

			else{
             ?>
				<div class="card-body flex-column"><small>No Record Found</small></div>

			<?}

		}

 

		//echo json_encode($results);

	}
	?>