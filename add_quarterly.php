<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	// $user obj is created in the inc below.
	require_once('login_check.php');
		
	$post = false;

	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$qtr = new Quarterly();
		$post = true;

		$qtr->maintenance_name = addslashes($_POST['title']);
		

		if($qtr->save()){
			header('location:quarterly.php?compat=1');
		}else{
			$msg = "All fields are required.";
		}
	}

	

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
	<title>Add Quarterly Checklist Item</title>
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
						<h4 class=" text-primary">dd Quarterly Checklist Item</h4>
						<hr />
						<form method="POST" action="" name="addprodform" id="addprodform" >
						
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Maintenance Title</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								
								<input type="text" class="form-control" name="title" placeholder="Engine Overhauling"  required  />
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
								 <input type="submit"  name="submit" class="btn btn-primary" value="Add to Checklist"   />
							</div>
							
						</div>
						
					</div>
				</div>
			</div>
		</div>
		
	<?php require_once('foot_inc.php'); ?>  
</body>

</html>