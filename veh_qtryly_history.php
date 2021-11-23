<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	
	if(isset($_GET['id'])){
		$vehicle = new Vehicle();
		$maint_history = $vehicle->get_vehicle_qrtrly_maint_data(addslashes(($_GET['id'])));
		
	}else{
		header("location: vehicles.php");
	}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
	<title>Vehicle Quarterly History</title>
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
										<h4 class=" text-primary">Vehicle Quarterly History</h4>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" style="text-align:right;" >
										
									</div>
								</div>
							</div>
						  <div class="panel-body">
							<table class="table" width="100%">
							<tr>
								<th>#</th>
								<th>Maintenance Type</th>
								<th>Remakrs</th>
								<th>Process Date</th>
							</tr>
							<?php $c= 1;
							foreach($maint_history as $veh){ ?>
							
							<tr>
								<td><?php echo $c; ?></td>
								<td><?php echo $veh['maintenance_name']; ?></td>
								<td><?php echo $veh['Remarks']; ?></td>
								<td><?php echo date('d-m-Y', strtotime($veh['created'])) ?></td>
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