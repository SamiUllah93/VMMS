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
			
				<h4 style="text-align:center;font-size:3.0em;color:#7cc15a;">Dashboard information and statistics</h4>
				<BR>
				<div class="row box">
					<a href="vehicles.php">
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:3.0em;">50</span><br />
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
							<span style="font-size:3.0em;">20</span><br />
							<b>Drivers</b>
							<br />
							<br />
							<i style="font-size:2.4em;color:#7cc15a;"class="fa fa-car"></i>
						</p></a>
						
						</div>
					</div>
					
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:3.0em;">20</span><br />
							<b>Maintainance</b>
							<br />
							<br />
							<i style="font-size:2.4em;color:#7cc15a;" class="fa fa-wrench" aria-hidden="true"></i>
						</p>
						
						</div>
					</div>
					
					<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12" style="text-align:center;padding-top:10px;">
						<div class="well">
						<p>
							<span style="font-size:3.0em;">20</span><br />
							<b>Alerts</b>
							<br />
							<br />
							<i style="font-size:2.4em;color:#7cc15a;" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
						</p>
						
						</div>
					</div>
				</div>
			</div>
		</div>

<?php require_once('foot_inc.php'); ?>  
</body>
</html>