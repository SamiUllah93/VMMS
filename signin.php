<?php
    //require "autoload.php";
    //require 'core/bootstrap/app.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sign In - VMMS</title>
  
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <?php require_once('head_inc.php'); ?>  
</head>
<body>
	<br />
	<div class="container">
		<div class="text-center">
			<img src="static/img/logo.png" width="250">
		</div>
		<form>
			<div class="col-md-4"></div>
			<div class="col-md-4 login-form">
				<div class="text-center">
					<h3>SIGN IN</h3>
				</div>
				<div class="">
					<hr />
					Email: <br />
					<input type="text" placeholder="username/email" name="email" id="email" required class="form-control" />
					<br />
					Password: <br />
					<input type="password" placeholder="password" name="pass" id="pass" required class="form-control" />
					<br />
					<button class="btn btn-success" style="width: 100%;">Sign In</button>
					<br />
					<br />
				</div>
			</div>
			<div class="col-md-4"></div>
		</form>
	</div>
	
	
<?php require_once('foot_inc.php'); ?>  
</body>
</html>