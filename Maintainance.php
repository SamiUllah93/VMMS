<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	
	$maint = new Maintainance();
	$all_maint = $maint->get_all();
	
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
										<h4 style="color:#449D44;">Maint</h4>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
										<a  href="add_maintenance.php"><button style="float:right"class="btn btn-success"><i class="fa fa-plus-circle" ></i> Add New Maint Type</button></a>
									</div>
								</div>
							</div>
						  <div class="panel-body">
							<table class="table" width="100%">
							<tr>
								<th>#</th>
								<th>Maint Type</th>
								<th>Added On</th>
								<th>Edit</th>
								
							</tr>
							<?php
								$c = 1;
								 foreach($all_maint as $maint_){
								 ?>
							<tr>
								<td><?php echo $c; ?></td>
								<td><?php echo $maint_['title'];?></td>
								<td><?php echo $maint_['created'];?></td>
								<td><a href="EditMaintenance.php?id=<?php echo $maint_['maintenance_id']; ?>">Edit</a></td>
							</tr>
							<?php $c++; } ?>
							

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