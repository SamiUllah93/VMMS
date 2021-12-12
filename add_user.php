<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	// $user obj is created in the inc below.
	require_once('login_check.php');
		
	$post = false;

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$driver = new User();
		$post = true;

		$driver->Name = addslashes($_POST['name']);
		$driver->Email = addslashes($_POST['email']);
		$driver->Password = addslashes($_POST['password']);

		if($driver->save()){
			header('location:users.php?compat=1');
			
		}else{
			$msg = "All fields are required.";
		}
	}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
	<title>Add Driver</title>
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
						<h4 class=" text-primary">Add New User</h4>
						<hr />
						<form method="POST" action="" name="addprodform" id="addprodform" >
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Email</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								
								<input type="text" class="form-control" name="email" placeholder="example@gmai.com;"  required  />
							</div>
							
						</div>
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Name</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								
								<input type="text" class="form-control" name="name" placeholder="Alex"  required  />
								<br />
								<?php
									if($post==true){
										echo $msg;
									}
								?>
							</div>
							
						</div>
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Password</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								
								<input type="text" class="form-control" name="password" placeholder="Alex"  required  />
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
								 <input type="submit"  name="submit" class="btn btn-primary" value="Add User"   />
							</div>
							
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
	<?php require_once('foot_inc.php'); ?>  
</body>

</html>