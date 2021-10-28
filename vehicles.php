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
				
				<div class="row">
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:10px;">
						
						<div class="panel panel-default">
						  <!-- Default panel contents -->
						  <div class="panel-heading">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
										<h4 style="color:#449D44;">Vehicles</h4>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
										<a  href="add_vehicles.php"><button style="float:right"class="btn btn-success"><i class="fa fa-plus-circle" ></i> Add Vehicle</button></a>
									</div>
								</div>
							</div>
						  <div class="panel-body">
							<table class="table" width="100%">
							<tr>
								<th>#</th>
								<th>BA.NO</th>
								<th>Type</th>
								<th>Make</th>
								<th>Year of Mfr</th>
								<th>Added On</th>
								<th>Edit</th>
								<th>Delete</th>
							</tr>
						
							<tr>
								<td>1</td>
								<td>RLG-566</td>
								<td>Car</td>
								<td>Toyota</td>
								<td>2015</td>
								<td>21-10-2019</td>
								<td>Edit</a></td>
								<td><i class="fa fa-close" style="color:red;"></i></a></td>
							</tr>
							<tr>
								<td>2</td>
								<td>RLA-452</td>
								<td>Jeep</td>
								<td>Toyota</td>
								<td>2010</td>
								<td>21-10-2019</td>
								<td>Edit</a></td>
								<td><i class="fa fa-close" style="color:red;"></i></a></td>
							</tr>
							
							<tr>
								<td>3</td>
								<td>RL-12-156</td>
								<td>Truck</td>
								<td>FORD</td>
								<td>2012</td>
								<td>21-10-2019</td>
								<td>Edit</a></td>
								<td><i class="fa fa-close" style="color:red;"></i></a></td>
							</tr>
							
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