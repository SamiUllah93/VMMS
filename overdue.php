<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	$vehicle = new Vehicle(); 
	$pending = $vehicle->overdue();


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
				
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:10px;">
					
						<div class="panel panel-default">
						  <!-- Default panel contents -->
						  <div class="panel-heading">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
										<h4 class=" text-primary">Overdue</h4>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >

									</div>
								</div>
							</div>
							
						  <div class="panel-body">
							<table class="table" width="100%">
							<tr>

								<th>#</th>
								<th>BA.No</th>
								<th>Dvr</th>
								<th>Maint Type</th>
								<th>Due On</th>
								<th>Days Passed</th>
								<th>Action</th>

							</tr>
						<?php 
						$c = 1;
						$prev = "";
						foreach($pending as $veh){ 
							 
							?>

						
							<tr>
								<td>
									<?php
										if($veh['BA_NO']==$prev){
											echo "";
										}else{
											echo $c;  
										}
										
									?>
								</td>
								<td>
									<?php
										if($veh['BA_NO']==$prev){
											echo "";
										}else{
											echo $veh['BA_NO'];  
										}
										
									?>
								</td>
								<td>
									<?php
										if($veh['BA_NO']==$prev){
											echo "";
										}else{
											echo $veh['name'];  
										}
										
									?>
								</td>								
								<td><?php echo $veh['title'];  ?></td>
								
								<td><?php echo date('d-m-Y', strtotime($veh['pending_on'])); ?></td>
								<td><?php 
								echo $veh['Remaing_days'] * -1;
								?></td>
								<td><a href="process_maintenance.php?id=<?php echo $veh['ID']; ?>"><button class="btn btn-primary btn-sm">Process</button></a></td>
							</tr>
						<?php
								
							if($veh['BA_NO']!=$prev){
								$c++;
							}
							$prev = $veh['BA_NO']; } 
							?>		 
							
																		
							
							
						  </table>
						  </div>

						  <!-- Table -->
						  
						</div>
					</div>
					
					</div> 
					 
				</div>
                <br />
				 
            </div>
        </div>

	
	<?php require_once('foot_inc.php'); ?>  
</body>
</html>