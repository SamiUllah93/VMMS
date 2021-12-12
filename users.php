<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	
	$user = new User();
	$data = $user->get_all();
	
	


?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Users</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <?php require_once('head_inc.php'); ?>  
</head>
<body>
	<?php require_once('nav_inc.php'); ?> 
	
	        <div id="page-content-wrapper">
            <div class="container-fluid">
				
				<div class="row">
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:10px;">
					
						
			
						<div class="panel panel-default">
						  <!-- Default panel contents -->
						  <div class="panel-heading">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
									<h4 class=" text-primary">Users</h4>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
										<a  href="add_user.php"><button style="float:right"class="btn btn-primary"><i class="fa fa-plus-circle" ></i> Add User</button></a>
									</div>
								</div>
							</div>
						  <div class="panel-body">
							<table class="table" width="100%">
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Email </th>
								<th>Added On</th>
								<th>Delete</th>
							</tr>
							<?php 
								$c = 1;
								foreach($data as $all_users){
									
								?>
							<tr>
								<td><?php echo $c; ?></td>
								<td><?php echo $all_users['name']; ?></td>
								<td><?php echo $all_users['email']; ?></td>
								
								<td><?php echo date('d-m-Y', strtotime($all_users['created'])); ?></td>
								
								<td>
								
									<a onclick="return confirm_alert(this);" href="users.php?del=<?php echo $driver_array['driver_id']; ?>" title="Delete Driver" ><i class="fa fa-close" style="color:red;"></i></a>
									
								</td>
							</tr>
							<?php
							$c++; 
								}
							?>
							
						  </table>
						  </div>

						  <!-- Table -->
						  
						</div>
					</div>
					
					 
					 
				</div>
                <br />
				 
            </div>
        </div>

		<script>
		function confirm_alert(node) {
			return confirm("This company might be linked to Vehicles. Delete company will clear the vehicle company relation as well.");
		}
		</script>
	<?php require_once('foot_inc.php'); ?>  
</body>
</html>