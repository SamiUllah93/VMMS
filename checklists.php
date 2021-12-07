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
	<title>Checklists</title>
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
					<?php if($msg_rec){ ?>
						<div class="alert alert-info" role="alert" style="width:40%;"><?php echo $msg; ?></div>
					<?php } ?>
						<div class="panel panel-default">
						  <!-- Default panel contents -->
						  <div class="panel-heading">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
										<h4 class=" text-primary">Vehicles</h4>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
										<a  href="add_vehicles.php"><button style="float:right"class="btn btn-primary"><i class="fa fa-plus-circle" ></i> Add Vehicle</button></a>
									</div>
								</div>
							</div>
						  <div class="panel-body">
							<table class="table" width="100%">
							<tr>
								<th>#</th>
								<th>BA.No</th>
								<th>Make & Type</th>
								<th>Issued On</th>
								<th>Year of Mfr</th>
								<th>Company</th>
								<th>Dvr</th>
								<th>Added On</th>
								<th>History</th>
								<th>Items</th>
								<th>Checklists</th>
								<th>Usages</th>
								<!-- <th>Edit</th> -->
								<th>Delete</th>
							</tr>
							<?php $c= 1;
							foreach($vehicles as $veh){ ?>
							<tr>
								<td><?php echo $c; ?></td>
								<td><?php echo $veh['BA_NO']; ?></td>
								<td><?php echo $veh['Make_Type']; ?></td>
								<td><?php echo $veh['Issued_On']; ?></td>
								<td><?php echo $veh['Year_of_Manufacturer']; ?></td>
								<td>
									<?php  if($veh['title']){ ?>
											<?php echo $veh['title']; ?> &nbsp; <a href="attach_company.php?VehID=<?php echo $veh['Vehicle_ID']; ?>"><i class="fa fa-edit" title="Change Company"></i></a>
									<?php
									}else{
											echo "<a href='attach_company.php?VehID=".$veh['Vehicle_ID']."'>Attach Company</a>";
									 }
									?>
								</td>
								<td>
									<?php  if($veh['name']){ ?>
											<?php echo $veh['name']; ?> &nbsp; <a href="attach_driver.php?VehID=<?php echo $veh['Vehicle_ID']; ?>"><i class="fa fa-edit" title="Change Driver"></i></a>
									<?php
									}else{
											echo "<a href='attach_driver.php?VehID=".$veh['Vehicle_ID']."'>Attach Driver</a>";
									 }
									?>
								</td>
								<td><?php echo $veh['created']; ?></td>
								<th><a href="history.php?id=<?php echo $veh['Vehicle_ID']; ?>"><button class="btn btn-sm btn-primary"><i class="fa fa-calendar"></i> Maint History</button></a></th>
								<th><a href="parts.php?id=<?php echo $veh['Vehicle_ID']; ?>"><button class="btn btn-sm btn-primary"><i class="fa fa-wrench"></i> Items Changed/Installed</button></a></th>
								<td>
									<a href="quarterly.php?vid=<?php echo  $veh['Vehicle_ID']; ?>"><button class="btn btn-sm btn-primary">Quarterly</button></a> &nbsp;  <a href="yearly.php?vid=<?php echo  $veh['Vehicle_ID']; ?>"><button class="btn btn-sm btn-primary">Yearly</button></a>
								</td>
								<th><a href="vehcile_usage.php?id=<?php echo $veh['Vehicle_ID']; ?>"><button class="btn btn-sm btn-primary">Usages</button></a></th>
								<!-- <td>Edit</a></td> -->
								<td>
									<a onclick="return confirm_alert(this);" href="vehicles.php?del=<?php echo $veh['Vehicle_ID']; ?>&drid=<?php echo $veh['Driver_ID']; ?>" title="Delete Vegicle" ><i class="fa fa-close" style="color:red;"></i></a>
								</td>
							</tr>
							<?php $c++; } ?>
						
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