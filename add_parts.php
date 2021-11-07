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
		$part_name = addslashes($_POST['part_name']);
		$Added_date = addslashes($_POST['Added_date']);
		if($vehicle->insert_part($part_name, $vehicle_id, $Added_date)){
			header('location: parts.php?id='.$vehicle_id);
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
	<title>Add Driver</title>
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
						<span style="font-size:0.95em;color:#449D44;"><b>Add New Driver</b></span>
						<hr />
						<form method="POST" action="" name="addprodform" id="addprodform" >
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>BA NO</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								
								<input type="hidden"   value="<?php echo $vehicle->pk_value; ?>" class="form-control" name="vehicle_id"   required  />
								<input type="text" disabled readonly value="<?php echo $vehicle->BA_NO; ?>" class="form-control" name="armyno"   required  />
							</div>
							
						</div>
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Make Type</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								
								<input type="text" disabled readonly value="<?php echo $vehicle->Make_type; ?>" class="form-control" name="armyno"   required  />
							</div>
							
						</div>
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Part Name</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								
								<input type="text" class="form-control" name="part_name" placeholder="Clutch Set"  required  />
								
							</div>
							
						</div>
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Date Changed/Installed</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								
								<input type="date"  value="" class="form-control" name="Added_date"   required  />
							</div>
							
						</div>
						<br />
								<?php
									if($post==true){
										echo $msg;
									}
								?>
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:5px;text-align:right;">
								<span style="color:red;"></span><br />
								 <input type="submit"  name="submit" class="btn btn-success" value="Add Record"   />
							</div>
							
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
	<?php require_once('foot_inc.php'); ?>  
</body>

</html>