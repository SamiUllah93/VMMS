<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	
	$cmp = new Company();

	if (isset($_GET['del'])){
		$cmp->pk_value = addslashes($_GET['del']);
		if($cmp->remove()){
			header('location: company.php');
		}
	}

	$all_comp = $cmp->get_all();
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Companies</title>
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
									<h4 class=" text-primary">Companies</h4>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
										<a  href="add_company.php"><button style="float:right"class="btn btn-primary"><i class="fa fa-plus-circle" ></i> Add Company</button></a>
									</div>
								</div>
							</div>
						  <div class="panel-body">
							<table class="table" width="100%">
							<tr>
								<th>#</th>
								<th>Company Name</th>
								<th>Added On</th>
								<th>Delete</th>
							</tr>
							<?php 
								$c = 1;
								foreach($all_comp as $comp){
								?>
							<tr>
								<td><?php echo $c; ?></td>
								<td><?php echo $comp['title']; ?></td>
								<td><?php echo $comp['created']; ?></td>
								<td>
									<a onclick="return confirm_alert(this);" href="company.php?del=<?php echo $comp['company_id']; ?>" title="Delete Company" ><i class="fa fa-close" style="color:red;"></i></a>
								</td>
							</tr>
							<?php
							$c++; 
								}
							?>
							
						  </table>
						  </div>

						  <!-- Table -->
						  
						</div>
					</div>
					
					 
					 
				</div>
                <br />
				 
            </div>
        </div>
		
		<script>
		function confirm_alert(node) {
			return confirm("This company might be linked to Vehicles. Delete company will clear the vehicle company relation as well.");
		}
		</script>
	<?php require_once('foot_inc.php'); ?>  
</body>
</html>