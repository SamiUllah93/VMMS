<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	date_default_timezone_set("Asia/Karachi");
	// $user obj is created in the inc below.
	require_once('login_check.php');
	$vehicle = new Vehicle(); 
	//$pending = $vehicle->alerts();


	/*
		Set dates here
	*/

	$c_year = date("Y");
	$today = date("Y-m-d");
	//$dateTime = date('Y-m-d', $c_year."-12-1");
	$q1_dt = date_create($c_year."-4-1");
	$q2_dt = date_create($c_year."-7-1");
	$q3_dt = date_create($c_year."-10-1");
	$yr_dt = date_create($c_year."-12-31");
	$today_dt = new DateTime($today);


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
		else{
			$pending = $vehicle->alerts();
		}
	}else{
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
	<style>
		@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
	</style>
</head>
<body>
	<?php require_once('nav_inc.php'); ?> 
	
	        <div>
            <div class="container-fluid">
				<div class="row no-print">
					<a href="Alerts.php"><div class="col-lg-4 col-md-4 text-center tab active" >
						Regular Maint
					</div></a>
					<a href="qtlyalterts.php"><div class="col-lg-4 col-md-4 text-center tab" >
						Qtly Maint
					</div></a>
					<a href="yralterts.php"><div class="col-lg-4 col-md-4 text-center tab">
						Yr Maint
					</div></a>
				</div>
				<br /><br />
				
				<div class="row">
				<form action="Alerts.php" method="POST">
					<div class="col-lg-2 col-md-3 col-sm-3 col-xs-3">
						Coy: 
						<select name="company" id="company" class="form-control"  >
							<option value="" selected  >Select Coy</option>
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
					Maint:<select name="Maintainance" id="Maintainance" class="form-control" >
						<option value="" selected  >Select Maint</option>
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
								<th>Dvr</th>
								<th>Maintainance Type</th>
								<th>Pending On</th>
								<th>Remaining Days</th>
								<th>Current ODO Meter-Reading</th>
								<th>Maintenance Distance</th>
								<th>Remaining distance</th>
								<th>Next process reading </th> 
								<?php
								if ($today_dt == $q1_dt || $today_dt == $q2_dt || $today_dt == $q3_dt ){ ?>
									<th>Qtly Check</th>
								<?php }
								?>
								<?php
								if ($today_dt == $yr_dt){ ?>
									<th>Yr Check</th>
								<?php }
								?>
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
							
								<td>
								<?php 
									if($veh['Remaing_days'] < 30 ) 
									{ 
								?>
									<span style="color:red;"> <?php echo $veh['Remaing_days']; ?> </span>

								<?php }

								else {
									echo $veh['Remaing_days'];
								
								}?></td>
								<td><?php echo $veh['current_reading'] ?></td>
								<td><?php echo $veh['distance'] ?></td>
								<td><?php 
									if($veh['next_distance']==null){
										echo "";
									}else{
										if($veh['next_distance']-$veh['current_reading'] < 0){
											echo "<span style='color:red;'>".($veh['next_distance']-$veh['current_reading'])."</span>";
										}else{
											echo $veh['next_distance']-$veh['current_reading'];
										}
									}
									
								?></td>
								<td><?php echo $veh['next_distance']; ?> </td>
								<?php
								if ($today_dt == $q1_dt || $today_dt == $q2_dt || $today_dt == $q3_dt ){ 
									if ($veh['BA_NO']!=$prev){ ?>
										
											<td>
												<a href="vehquarterly.php?vid=<?php echo $veh['veh_id']; ?>"><button class="btn btn-primary btn-sm">Process Qtly Checklist</button></a>
											</td>
								<?php 	} 
								else{
									echo "<td></td>"; 
							   } 
									}
								?>
								<?php
								if ($today_dt == $yr_dt){
									if ($veh['BA_NO']!=$prev){
										 ?>
											<td>
											<a href="vehyearly.php?vid=<?php echo $veh['veh_id']; ?>"><button class="btn btn-primary btn-sm">Process Yr Checklist</button></a>
											</td>
									<?php }
									else{
										echo "<td></td>"; 
								   } 
									}
								?>
								<td><a class="no-print" href="process_maintenance.php?id=<?php echo $veh['ID']; ?>"><button class="btn btn-primary btn-sm no-print">Process</button></a></td>
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