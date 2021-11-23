<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	$driver = new Driver();
	$drivers = $driver->get_count();

	$vehicle = new Vehicle();
	$vehicles = $vehicle->get_count();
	$count = $vehicle->dashboard_count();
	$average = $vehicle->total_average_count();
	$pending_count = $vehicle->pending_today_count();
	$alert_count = $vehicle->alerts_count();

	$maint = new Maintainance();
	$maints = $maint->get_count();
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
			
				<h4 style="text-align:center;font-size:2.0em;" class="text-primary">Dashboard Information & Statistics</h4>
				<BR>
				<div class="row box">
					<a href="vehicles.php">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:2.0em;" class="text-primary"><?php echo $vehicles; ?></span><br />
							<b>VEHS</b>
							<br />
							<br />
							<i style="font-size:2.4em;" class="fa fa-car text-primary"></i>
						</p>
						</div>
					</div></a>
					<a href="drivers.php">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:2.0em;"><?php echo $drivers; ?></span><br />
							<b>Drvrs</b>
							<br />
							<br />
							
							<i style="font-size:2.4em;"class="fa fa-drivers-license text-primary"></i>
						</p></a>
						
						</div>
					</div>
					<a href="Maintainance.php">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:2.0em;"><?php echo $maints; ?></span><br />
							<b>Maint</b>
							<br />
							<br />
							<i style="font-size:2.4em;" class="fa fa-wrench color:#7cc15a;" aria-hidden="true"></i>
						</p>
						
						</div></a>
					</div>
					<a href="alerts.php">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:2.0em;"><?php echo $alert_count; ?></span><br />
							<b>Alerts</b>
							<br />
							<br />
							<i style="font-size:2.4em;" class="fa fa-exclamation-triangle text-primary" aria-hidden="true"></i>
						</p>
						
						</div>
					</div></a>
				</div>
				<!-- 2nd row --> 
				<div class="row box">
					<a href="fuelconsumption.php">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:2.0em;"><?php echo number_format($average[0]['average'],2) ?> Km/Lit</span><br />
							<b>Average Fuel Consumption</b>
							<br />
							<br />
							<i style="font-size:2.4em;" class="fa fa-tachometer  text-primary" ></i>
						</p>
						
						</div>
					</div> </a>
					<a href="Total_running.php">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:2.0em;"><?php echo $count[0]['dashboard_count'] ?> kms</span><br />
							<b>Total Running</b>
							<br />
							<br />
							<i style="font-size:2.4em;"class="fa fa-calculator  text-primary"></i>
						</p></a>
						
						</div>
					</div>
					<a href="alertsToday.php">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:2.0em;"><?php echo $pending_count; ?></span><br />
							<b>Pending Today</b>
							<br />
							<br />
							<i style="font-size:2.4em;" class="fa fa-hourglass  text-primary" aria-hidden="true"></i>
						</p>
						
						</div></a>
					</div>
					
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:2.0em;">1</span><br />
							<b>Users</b>
							<br />
							<br />
							<i style="font-size:2.4em;" class="fa fa-user  text-primary" aria-hidden="true"></i>
						</p>
						
						</div>
					</div></a>
				</div>
				
				
				
			</div>
		</div>

<?php require_once('foot_inc.php'); ?>  
</body>
</html>