<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	
	$driver = new Driver();
	$all_drivers = $driver->get_all();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Drivers</title>
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
										<h4 style="color:#449D44;">Drivers</h4>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
										<a  href="add_drivers.php"><button style="float:right"class="btn btn-success"><i class="fa fa-plus-circle" ></i> Add Driver</button></a>
									</div>
								</div>
							</div>
						  <div class="panel-body">
							<table class="table" width="100%">
							<tr>
								<th>#</th>
								<th>ARMY NO</th>
								<th>Driver Name</th>
								<th>Car Assigned to</th>
								<th>Added On</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
							<?php 
								$c = 1;
								foreach($all_drivers as $driver_array){
								?>
							<tr>
								<td><?php echo $c; ?></td>
								<td><?php echo $driver_array['armyno']; ?></td>
								<td><?php echo $driver_array['name']; ?></td>
								<td>--</td>
								<td><?php echo $driver_array['created']; ?></td>
								<td>Edit</a></td>
								<td><i class="fa fa-close" style="color:red;"></i></a></td>
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

	
	<?php require_once('foot_inc.php'); ?>  
</body>
</html>