<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	
	$post = false;

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$vehicle = new Vehicle();
		$post = true;
		$vehicle_id = addslashes($_POST['vehicle_id']);
		$running = addslashes($_POST['running']);
		$fuel = addslashes($_POST['fuel']);
		if($vehicle->insert_usage($vehicle_id, $fuel, $running)){
			header('location: vehcile_usage.php?id='.$vehicle_id);
		}else{
			$msg = "All fields are required.";
		}
	}

	
	if(isset($_GET['id'])){
		$vehicle = new Vehicle($_GET['id']);		
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
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box" style="padding-top:10px;">
						<span style="font-size:0.95em;color:#449D44;"><b>Add Usage</b></span>
						<hr />
						<form method="POST" action="" name="addprodform" id="addprodform" >
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Fueling/Usage Date</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								<input type="text" readonly value="<?php echo date("jS F Y"); ?>" class="form-control" required  />
								<input type="hidden"   value="<?php echo $vehicle->pk_value; ?>" class="form-control" name="vehicle_id"   required  />
							</div>
							
						</div>
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Vehicle Make</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								<input type="text" readonly value="<?php echo $vehicle->Make_type; ?>" class="form-control" required  />
							</div>
							
						</div>
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>BA Number</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								<input type="text" readonly value="<?php echo $vehicle->BA_NO; ?>" class="form-control" required  />
							</div>
							
						</div>
						

						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Fuel in Liters</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								<input type="number" class="form-control" name="fuel" placeholder="Fuel in Liters"  required  />
							</div>
							
						</div>
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Running in KMs</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								<input type="number" class="form-control" name="running" placeholder="Running in KMs"  required  />
							</div>
							
						</div>
						
						</div>
						<div class="row" style="padding-top:10px;margin-right:5px">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-right:5px;text-align:right;">
								<span style="color:red;"></span><br />
								 <input type="submit"  name="submit" class="btn btn-success" value="Add Usage"   />
							</div>
							
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
	<?php require_once('foot_inc.php'); ?>  
</body>

</html>