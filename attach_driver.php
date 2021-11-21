<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	$post = false;

	if (isset($_GET['VehID']))	{
		$veh_id = addslashes($_GET['VehID']);
		$veh = new Vehicle($veh_id);
	}
	
	$dvr = new Driver();
	$all_dvr =  $dvr->get_all_keyval('status', '0'); 
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$veh = new Vehicle();
		$post = true;
		 
		$driver_id = addslashes($_POST['driver_id']);
		$VehID = addslashes($_POST['veh_id']);
		print_r($driver_id);
		if($veh->attach_driver_to_vehicle($driver_id, $VehID)){
			header('location:vehicles.php?compat=1');
		}else{
			$msg = "All fields are required.";
		}
	}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
	<title>Attach Company</title>
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
							<span style="font-size:0.95em;color:#449D44;"><b>Attach Driver</b></span>
							<hr />
						<form method="POST" action=""  >
							
							<div class="row" style="padding-top:10px;">
								<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
									<b>Vehicle BA/NO</b>
								</div>
								<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
									<input type="text" readonly class="form-control" name="title" value="<?php echo $veh->BA_NO; ?>" required  />
									<input type="hidden" name="veh_id" value="<?php echo $veh_id; ?>"   />
									<br />
								</div>
							</div>

							<div class="row" style="padding-top:10px;">
								<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
									<b>Yr of Mfr</b>
								</div>
								<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
									<input type="text" readonly class="form-control" name="title" value="<?php echo $veh->Year_of_Manufacturer; ?>" required  />
									<br />
								</div>
							</div>
							<div class="row" style="padding-top:10px;">
								<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
									<b>Make Type</b>
								</div>
								<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
									<input type="text" readonly class="form-control" name="title" value="<?php echo $veh->Make_type; ?>" required  />
									<br />
								</div>
							</div>
							<div class="row" style="padding-top:10px;">
								<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
									<b>Company</b>
								</div>
								<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
									<select name="driver_id" required class="form-control">
										<option value="" disabled selected>Select Driver</option>
										<?php 
										$c = 1;
											foreach($all_dvr as $dvvr){
										?>
											<option value="<?php echo $dvvr['driver_id']; ?>"><?php echo $dvvr['name']; ?></option>
										<?php } ?> 
									</select>
									<br />
								</div>
							</div>
							</div>
							<?php
							if($post==true){
								echo $msg;
							} ?>
							<div class="row" style="padding-top:10px;margin-right:5px">
								<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-right:5px;text-align:right;">
									<span style="color:red;"></span><br />
									<button type="submit"   class="btn btn-primary">Attach Company</button>
								</div>
								
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
	<?php require_once('foot_inc.php'); ?>  
</body>

</html>