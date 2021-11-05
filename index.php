<?php
    //require "autoload.php";
    //require 'core/bootstrap/app.php';
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
			
				<h4 style="text-align:center;font-size:2.0em;color:#7cc15a;">Dashboard Information & Statistics</h4>
				<BR>
				<div class="row box">
					<a href="vehicles.php">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:2.0em;">50</span><br />
							<b>Vehicles</b>
							<br />
							<br />
							<i style="font-size:2.4em;color:#7cc15a;"class="fa fa-car"></i>
						</p>
						</div>
					</div> </a>
					<a href="drivers.php">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:2.0em;">20</span><br />
							<b>Drivers</b>
							<br />
							<br />
							
							<i style="font-size:2.4em;color:#7cc15a;"class="fa fa-drivers-license"></i>
						</p></a>
						
						</div>
					</div>
					<a href="Maintainance.php">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:2.0em;">30</span><br />
							<b>Maintenance</b>
							<br />
							<br />
							<i style="font-size:2.4em;color:#7cc15a;" class="fa fa-wrench" aria-hidden="true"></i>
						</p>
						
						</div></a>
					</div>
					<a href="alerts.php">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:2.0em;">10</span><br />
							<b>Alerts</b>
							<br />
							<br />
							<i style="font-size:2.4em;color:#7cc15a;" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
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
							<span style="font-size:2.0em;">156.9 KM/Lit</span><br />
							<b>Average Fuel Consumption</b>
							<br />
							<br />
							<i style="font-size:2.4em;color:#7cc15a;" class="fa fa-tachometer"></i>
						</p>
						
						</div>
					</div> </a>
					<a href="Total_running.php">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:2.0em;">2000 KM</span><br />
							<b>Total Running</b>
							<br />
							<br />
							<i style="font-size:2.4em;color:#7cc15a;"class="fa fa-calculator"></i>
						</p></a>
						
						</div>
					</div>
					<a href="alertsToday.php">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:2.0em;">12</span><br />
							<b>Pending Today</b>
							<br />
							<br />
							<i style="font-size:2.4em;color:#7cc15a;" class="fa fa-hourglass" aria-hidden="true"></i>
						</p>
						
						</div></a>
					</div>
					<a href="vehcile_usage.php">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:2.0em;">30</span><br />
							<b>Usages</b>
							<br />
							<br />
							<i style="font-size:2.4em;color:#7cc15a;" class="fa fa-gas-pump" aria-hidden="true"></i>
						</p>
						
						</div>
					</div></a>
				</div>
				
				
				
			</div>
		</div>

<?php require_once('foot_inc.php'); ?>  
</body>
</html>