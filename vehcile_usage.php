<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	if(isset($_GET['id'])){
		$vehicle = new Vehicle();
		$vehicles = $vehicle->vehicle_usage(($_GET['id']));
		
	}else{
		header("location: vehicles.php");
	}
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
									<h4 class=" text-primary">Vehicles Usage</h4>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
										<a  href="add_usage.php?id=<?php echo addslashes(($_GET['id'])); ?>"><button style="float:right"class="btn btn-primary"><i class="fa fa-plus-circle" ></i> Add Usage</button></a>
									</div>
								</div>
							</div>
						  <div class="panel-body">
						  
							<table class="table" width="100%">
							<tr>
								<th>#</th>
								<th>Date</th>
								<th>Vehicle Running(KMs)</th>
								<th>Fuel Qty (lit)</th>
							</tr>
							<?php $c= 1;
							foreach($vehicles as $veh){ ?>
							<tr>
								<td><?php echo $c; ?></td>
								<td><?php echo date('d-m-Y', strtotime($veh['created'])); ?></td>
								<td><?php echo $veh['total_running']; ?></td>
								<td><?php echo $veh['total_fuel_added']; ?> Liters</td>
								
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