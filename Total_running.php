<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	
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
										<h4 style="color:#449D44;">Total Running</h4>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >

									</div>
								</div>
							</div>
						  <div class="panel-body">
							<table class="table" width="100%">
							<tr>
								<th>#</th>
								<th>BA NO</th>
								
								<th>Total Running</th>
								

							</tr>
						
							<tr>
								<td>1</td>
								<td>RLG-456</td>
								
								<td>500 KM</td>								
								
							</tr>
							<tr>
								<td>2</td>
								<td>RLA-489</td>
								
								<td>2500 KM</td>								
								
							</tr>
							<tr>
								<td>3</td>
								<td>RLC-563</td>
								
								<td>1500 KM</td>								
								
							</tr>
							<tr>
								<td>4</td>
								<td>RL-12-236</td>
							
								<td>1000 KM</td>								
							
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