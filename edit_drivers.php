<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	// $user obj is created in the inc below.
	require_once('login_check.php');
		
	$post = false;

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$driver = new Driver();
		$post = true;

		$driver->pk_value = addslashes($_POST['pk_value']);
		$driver->name = addslashes($_POST['name']);
		$driver->armyno = addslashes($_POST['armyno']);

		if($driver->update()){
			header('location:drivers.php?compat=2');
		}else{
			$msg = "All fields are required.";
		}
	}

	if(isset($_GET['id'])){
		$driver = new Driver(addslashes($_GET['id']));
		
	}else{
		header("location: drivers.php");
	}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
	<title>Driver Edit</title>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <?php require_once('head_inc.php'); ?>  
</head>
<body>
	<?php require_once('nav_inc.php'); ?>      

	 <div id="page-content-wrapper">
            <div class="container-fluid">
				
				<div class="row">
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box" style="padding-top:10px;">
						<span style="font-size:0.95em;color:#449D44;"><b>Edit Driver</b></span>
						<hr />
						<form method="POST" action="" name="addprodform" id="addprodform" >
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Army NO</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								
								<input type="text" value="<?php echo $driver->armyno; ?>" class="form-control" name="armyno" placeholder="PA-7895416"  required  />
							</div>
							
						</div>
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Name</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
							<input type="hidden" class="form-control" value="<?php echo $driver->pk_value; ?>" name="pk_value"  />
								<input type="text" value="<?php echo $driver->name; ?>" class="form-control" name="name" placeholder="Alex"  required  />
								<br />
								<?php
									if($post==true){
										echo $msg;
									}
								?>
							</div>
							
						</div>
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:5px;text-align:right;">
								<span style="color:red;"></span><br />
								 <input type="submit"  name="submit" class="btn btn-primary" value="Update Driver"   />
							</div>
							
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
	<?php require_once('foot_inc.php'); ?>  
</body>

</html>