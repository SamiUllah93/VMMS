<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	
	$vehicle = new Vehicle();
	$vehicles = $vehicle->get_all();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
	<title>Vehicle Maintenance History</title>
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
										<h4 style="color:#449D44;">Vehicle Maintenance History</h4>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
									</div>
								</div>
							</div>
						  <div class="panel-body">
							<table class="table" width="100%">
							<tr>
								<th>#</th>
								<th>Maintenance Type</th>
								<th>Process Date</th>
								<th>Process ODO Meter Reading</th>
							</tr>
							<?php $c= 1;
							foreach($vehicles as $veh){ ?>
							<tr>
								<td><?php echo $c; ?></td>
								<td><?php echo $veh['BA_NO']; ?></td>
								<td><?php echo $veh['Make_Type']; ?></td>
								<td><?php echo $veh['Issued_On']; ?></td>
								<td><?php echo $veh['Year_of_Manufacturer']; ?></td>
								<td><?php echo $veh['created']; ?></td>
								<th><a href="history.php?id=<?php echo $veh['Vehicle_ID']; ?>"><button class="btn btn-sm btn-primary">History</button></a></th>
								<th><a href="parts.php"><button class="btn btn-sm btn-primary">Parts</button></a></th>
								<th><a href="vehcile_usage.php"><button class="btn btn-sm btn-primary">Usages</button></a></th>
								<td>Edit</a></td>
								<td><i class="fa fa-close" style="color:red;"></i></a></td>
							</tr>
							<?php $c++; } ?>
						
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