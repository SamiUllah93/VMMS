<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	
	
	if(isset($_GET['id'])){
		$vehicle = new Vehicle();
		$vehicles = $vehicle->get_vehicle_parts(addslashes(($_GET['id'])));
		
	}else{
		header("location: vehicles.php");
	}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
	<title>Vehicle Parts Data</title>
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
										<h4 style="color:#449D44;">Vehicle Parts Changed/Installed</h4>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
										<a  href="add_parts.php?id=<?php echo addslashes(($_GET['id'])); ?>"><button style="float:right"class="btn btn-success"><i class="fa fa-plus-circle" ></i> Add Part Change/Insall Record</button></a>
									</div>
								</div>
							</div>
						  <div class="panel-body">
							<table class="table" width="100%">
							<tr>
								<th>#</th>
								<th>Title</th>
								<th>Date Installed/Changed</th>
							</tr>
							<?php $c= 1;
							foreach($vehicles as $veh){ ?>
							<tr>
								<td><?php echo $c; ?></td>
								<td><?php echo $veh['title']; ?></td>
								<td><?php echo $veh['Added_date']; ?></td>
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