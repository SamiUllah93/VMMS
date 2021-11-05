<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	$maint = new Maintainance();
	$main_all = $maint->get_all();
	$driver = new Driver();
	$drivers = $driver->get_all();

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$vehicle = new Vehicle();
		$vehicle->BA_NO = addslashes($_POST['BANO']);
		$vehicle->Make_type = addslashes($_POST['MakeType']);
		$vehicle->Year_of_Manufacturer = addslashes($_POST['year']);
		$vehicle->Driver_ID = addslashes($_POST['driver_id']);
		$vehicle->Issued_On = addslashes($_POST['IssuedOn']);
		$vehicle->maint_data = $_POST['maintenance'];

		$vehicle->save();
	}


?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
	<title>Add Vehicle</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <?php require_once('head_inc.php'); ?>  
</head>
<body>
	<?php require_once('nav_inc.php'); ?>      

            <div class="container-fluid">
				
				<div class="row">
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box" style="padding-top:10px;">
						<span style="font-size:0.95em;color:#449D44;"><b>Add New Vehicle</b></span>
						<hr />
						<form method="POST" action="" >
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>BA.NO</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								
								<input type="text" class="form-control" name="BANO" placeholder="RLA-4565"  required  />
							</div>
							
						</div>
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Make Type </b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								
								<input type="text" class="form-control" name="MakeType" placeholder="Suzuki Baleno"  required  />
							</div>
							
						</div>
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Issues On</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								
								<input type="date" class="form-control" name="IssuedOn" placeholder="Issue Date"  required  />
							</div>
							
						</div>
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Year of Manufacturer</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								
								<input type="text" class="form-control" name="year" placeholder="2010,2011,2012"  required  />
							</div>
							
						</div> 
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Driver</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								<select name="driver_id"  class="form-control" required >
									<option value="" selected disabled >Select Driver</option>
									<?php 
									foreach($drivers as $drv){
									?>
									<option value="<?php echo $drv['driver_id']; ?>"><?php echo $drv['name']; ?></option>
									<?php } ?>
									
								</select>
							</div>
							
						</div>
							<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Type of Maintainance</b>
							</div>
							<?php
								$main_types = ["Oil Change", "Oil Filter Change", "Air Filter Change", "Brakes Service", "Tire Rotation", "Air Pressure"];
							?>
							
							
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								<?php foreach($main_all as $main){ ?>
									<div class="row">
									<div class="col-md-2" >
										<input type="checkbox" data-test=""  value="<?php echo $main['maintenance_id']; ?>" /> <?php echo $main['title']; ?>
									</div>
									<div class="col-md-6">
										<div class="row">
											<div class="col-md-6">
												<input placeholder="Duration in days" name="maintenance[<?php echo $main['maintenance_id']; ?>][days]" disabled class="form-control" type='text' >
											</div>
											<div class="col-md-6">
												<input placeholder="KMs" class="form-control" name="maintenance[<?php echo $main['maintenance_id']; ?>][kms]"  disabled type='text'>
											</div>
											
										</div>
										<br />
									</div>
								</div>
								<?php } ?>
							</div>
							
								
							
							<div class="row" style="padding-top:10px;">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:5px;text-align:right;">
								<span style="color:red;"></span><br />
								 <input type="submit"  name="submit" class="btn btn-success" value="Add Vehicle"   />
							</div>
							
						</div>
							</div>
						
						
						</form>
						
					</div>
					
					 
					 
				</div>
                <br />
				 
            </div>
       
	
	<?php require_once('foot_inc.php'); ?>  
</body>
<script type="text/javascript">
	// $("input[name=maintenance]").click(function(){
		$("[data-test]").click(function(){
			console.log($(this));
		if ($(this).is(':checked')) {
			$(this).parent().parent().children().children().children().children().prop('disabled', false);
		}else{
			$(this).parent().parent().children().children().children().children().prop('disabled', true);
		}
	 });
</script>
</html>