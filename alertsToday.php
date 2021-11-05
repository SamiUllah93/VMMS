<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  
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
										<h4 style="color:#449D44;">Pending Today</h4>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >

									</div>
								</div>
							</div>
						  <div class="panel-body">
							<table class="table" width="100%">
							<tr>
								<th>#</th>
								<th>Maintainance Type</th>
								<th>BA NO</th>
								<th>Driver</th>
								<th>Pending On</th>
								<th>Remaining Days</th>
								<th>Action</th>

							</tr>
						
							<tr>
								<td>1</td>
								<td>Engine oil Change</td>
								<td>RLG-456</td>
								<td>Ghafoor</td>								
								<td><?php echo date("jS F Y"); ?></td>
								<td>0</td>
								<td><a href="process_maintenance.php"><button class="btn btn-success btn-sm">Process</button></a></td>
							</tr>
														<tr>
								<td>2</td>
								<td>Air Filter</td>
								<td>RLG-456</td>
								<td>Asif</td>								
								<td><?php echo date("jS F Y"); ?></td>
								<td>0</td>
								<td><a href="process_maintenance.php"><button class="btn btn-success btn-sm">Process</button></a></td>
							</tr>
														<tr>
								<td>3</td>
								<td>Oil Filter</td>
								<td>RLG-456</td>
								<td>Chohan</td>								
								<td><?php echo date("jS F Y"); ?></td>
								<td>0</td>
								<td><a href="process_maintenance.php"><button class="btn btn-success btn-sm">Process</button></a></td>
							</tr>
														<tr>
								<td>4</td>
								<td>Brake Line Checking</td>
								<td>RLG-456</td>
								<td>Ahsan</td>								
								<td><?php echo date("jS F Y"); ?></td>
								<td>0</td>
								<td><a href="process_maintenance.php"><button class="btn btn-success btn-sm">Process</button></a></td>
							</tr>
														<tr>
								<td>5</td>
								<td>Tyre Change</td>
								<td>RLG-456</td>
								<td>Usman</td>								
								<td><?php echo date("jS F Y"); ?></td>
								<td>0</td>
								<td><a href="process_maintenance.php"><button class="btn btn-success btn-sm">Process</button></a></td>
							</tr>
							
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