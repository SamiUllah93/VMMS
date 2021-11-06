<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$veh = new Vehicle();
		$post = true;
		$veh_m_id = addslashes($_POST['veh_m_id']);
		$odo = addslashes($_POST['odo']);
		if($veh->process_maintenance($veh_m_id, $odo)){
			header("locaiton: alertsToday.php");
		}else{
			$msg = "All fields are required.";
		}
	}

	if(isset($_GET['id'])){
		$id = addslashes($_GET['id']);
		$veh = new Vehicle();
		$data = $veh->pending_today_by_id($_GET['id']);
	}else{
		header("locaiton: alertsToday.php");
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
						<span style="font-size:0.95em;color:#449D44;"><b>Process Maintenance</b></span>
						<hr />
						<form method="POST" action="" name="addprodform" id="addprodform" >
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Process Date</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								<input type="hidden" name="veh_m_id" readonly value="<?php echo $id; ?>" class="form-control" required  />
								<input type="text" readonly value="<?php echo date("jS F Y"); ?>" class="form-control" required  />
							</div>
							
						</div>
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Vehicle Make</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								<input type="text" readonly value="<?php echo $data[0]['Make_Type']; ?>" class="form-control" required  />
							</div>
							
						</div>
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>BA Number</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								<input type="text" readonly value="<?php echo $data[0]['BA_NO']; ?>" class="form-control" required  />
							</div>
							
						</div>
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Driver</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								<input type="text" readonly value="<?php echo $data[0]['name']; ?>" class="form-control" required  />
							</div>
							
						</div>
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Maintenance Type</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								<input type="text" readonly value="<?php echo $data[0]['title']; ?>" class="form-control" required  />
							</div>
							
						</div>
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>ODO Meter Reading</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								<input type="number" class="form-control" name="odo" placeholder="Meter Reading"  required  />
							</div>
							
						</div>
						
						</div>
						<div class="row" style="padding-top:10px;margin-right:5px">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-right:5px;text-align:right;">
								<span style="color:red;"></span><br />
								 <input type="submit"  name="submit" class="btn btn-success" value="Add Maintenance"   />
							</div>
							
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
	<?php require_once('foot_inc.php'); ?>  
</body>

</html>