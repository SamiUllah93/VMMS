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
            <div class="container">

				<div class="row">

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box" style="padding-top:10px;">
						<span style="font-size:0.95em;color:#449D44;"><b>Update Account</b></span>
						<form method="POST" action="" >
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-2 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Account ID</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">

								<input type="text" class="form-control" value="465" disabled  />
							</div>

						</div>

						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Email</b>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="text" name="email" class="form-control" value="rizwan@gmail.com" disabled  />
							</div>
						</div>

						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Name</b>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="text" name="f_name" class="form-control" value="Muhammad Rizwan" disabled  />
							</div>
						</div>


						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Current Password</b>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="password" name="password_current" class="form-control" placeholder="Current Password" value="" required  />
							</div>
						</div>

						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>New Password</b>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="password" name="password_new" class="form-control" placeholder="New Password" value="" required  />
							</div>
						</div>

						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Retype Password</b>
							</div>
							<div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
								<input type="password" name="password_new_r" class="form-control" placeholder="Retype Password" value="" required  />

							</div>
						</div>

						<div class="row" style="padding-top:10px;">
							<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-bottom:5px;text-align:right;">

								 <input type="submit" name="submit" class="btn btn-success" value="Update" onClick="" />
							</div>
						</div>
						</form>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 " >

					</div>
				</div>
                <br />

            </div>
       

   <?php require_once('foot_inc.php'); ?>  
</body>

</html>