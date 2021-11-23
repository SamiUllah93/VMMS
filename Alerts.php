<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	$vehicle = new Vehicle(); 
	//$pending = $vehicle->alerts();


	if(Isset($_POST['submit'])) {
		
		if (($_POST['from'] != '') && ($_POST['to'] !='') && ($_POST['Maintainance'] == '') && ($_POST['company'] =='') ){
			// call method which takes date only 
			
			$pending = $vehicle->dateonly_alerts($_POST['from'],$_POST['to']);
			
		} 
		
		else if (($_POST['from'] !='') && ($_POST['to'] !='') && ($_POST['Maintainance'] !='') && ($_POST['company']) == '') {
			$pending = $vehicle->dateandmain_alert($_POST['from'],$_POST['to'],$_POST['Maintainance']);
			

		} 
		else if (($_POST['from'] != '')  && ($_POST['to'] != '') && ($_POST['Maintainance'] == '') && ($_POST['company']) != '' ) {
			$pending = $vehicle->dateandcompany_alert($_POST['from'],$_POST['to'],$_POST['company']);
			

		} 
		else if (($_POST['from'] == '' )  && ($_POST['to'] == '') && ($_POST['Maintainance'] != '') && ($_POST['company']) != '') {
			$pending = $vehicle->maintandcompany_alert($_POST['Maintainance'],$_POST['company']);
			

		} 
		else if (($_POST['from'] == '' )  && ($_POST['to'] == '') && ($_POST['Maintainance'] == '') && ($_POST['company']) != '') {
			$pending = $vehicle->company_alert($_POST['company']);
			
			

		}
		else if (($_POST['from'] == '' )  && ($_POST['to'] == '') && ($_POST['Maintainance'] != '') && ($_POST['company']) == '') {
			
			$pending = $vehicle->maint_alert($_POST['Maintainance']);
			

		}
		else if (($_POST['from'] != '') && ($_POST['to'] != '') && ($_POST['Maintainance'] != '') && ($_POST['company'] !='') ) {
			
			$pending = $vehicle->allfilter_alert($_POST['from'],$_POST['to'],$_POST['Maintainance'],$_POST['company']);
			

		}
		
		
	} 
	
	else{

		$pending = $vehicle->alerts();
	}


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
				<form action="Alerts.php" method="POST">
					<div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
						Company: 
						<select name="company" id="company" class="form-control"  >
							<option value="" selected  >Select company</option>
								<?php 
									$company = new Company();
									$res = $company->get_all();
									foreach($res as $data){
								?>
										
							<option value="<?php echo $data['company_id']; ?>"> <?php echo $data['title']; ?></option>
								<?php }?>	
						</select>
					</div>
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-3" >
					Maintenanec:<select name="Maintainance" id="Maintainance" class="form-control" >
						<option value="" selected  >Select maintenance</option>
						<?php 			
							$Maintainance = new Maintainance();
							$res = $Maintainance->get_all();
							foreach($res as $data){
						?>					
						<option value="<?php echo $data['maintenance_id']; ?>"> <?php echo $data['title']; ?></option>
						<?php }?>	
					</select>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="display: inline-block;">
						 From: <input type="date" id="from" name="from" class="form-control"> 
						
					</div>	
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" >
						To: <input type="date" id="to" name="to" class="form-control">
					</div>						
					
					<div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
						<br /> &nbsp; <input type="submit"  name="submit" id="submit" class="btn btn-primary" value="Search Alerts" />
					</div>							
				</div>
				</form>
				<hr>
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-top:10px;">
					
						<div class="panel panel-default">
						  <!-- Default panel contents -->
						  <div class="panel-heading">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
										<h4 style="color:#449D44;">Alerts</h4>
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
								<th>Drvr</th>
								<th>Maintainance Type</th>
								<th>Pending On</th>
								<th>Remaining Days</th>
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
								
								<td><?php echo $veh['pending_on'] ?></td>
								<td><?php 
								echo $veh['Remaing_days']
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