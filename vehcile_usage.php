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
										<h4 style="color:#449D44;">Vehicles Usage</h4>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
										<a  href="add_usage.php"><button style="float:right"class="btn btn-success"><i class="fa fa-plus-circle" ></i> Add Usage</button></a>
									</div>
								</div>
							</div>
						  <div class="panel-body">
						  <b>Vehicle: </b> Suzuki <br />
						  <b>Type: </b> Car <br />
						  <b>Year of Make: </b> 2019
						  <br />
						  <hr />
							<table class="table" width="100%">
							<tr>
								<th>#</th>
								<th>Date</th>
								<th>Fuel Type</th>
								<th>Qty</th>
							</tr>
						
							<tr>
								<td>1</td>
								<td>2020-08-16</td>
								<td>Diesel</td>
								<td>24.98</td>
								
							</tr>
							
							<tr>
								<td>2</td>
								<td>2020-08-16</td>
								<td>Diesel</td>
								<td>24.98</td>
								
							</tr>
							
							<tr>
								<td>3</td>
								<td>2020-08-16</td>
								<td>Diesel</td>
								<td>24.98</td>
								
							</tr>
							
							<tr>
								<td>4</td>
								<td>2020-08-16</td>
								<td>Diesel</td>
								<td>24.98</td>
								
							</tr>
							
							<tr>
								<td>5</td>
								<td>2020-08-16</td>
								<td>Diesel</td>
								<td>24.98</td>
								
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