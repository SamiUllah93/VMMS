<?php
	require_once('config.php');
	Debug::$Debug_Mode = false;
	
	// $user obj is created in the inc below.
	require_once('login_check.php');
	$qtr_main = new Yearly;
	$quarters = $qtr_main->get_all();
	$msg_rec = false;



	if (isset($_GET['compat']))	{
		if($_GET['compat']=='1'){
			$msg = "Item added to checklist.";
			$msg_rec = true;
		}else if($_GET['compat']=='3'){
			$msg = "Item deleted from checklist.";
			$msg_rec = true;
		}
	}


	if (isset($_GET['del'])){
		$qtr_main->pk_value = addslashes($_GET['del']);
		
		
		if($qtr_main->remove()){
			header('location: yearly.php?compat=3');
		}
	}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
	<title>Yearly Checklist</title>
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
					<?php if($msg_rec){ ?>
						<div class="alert alert-info" role="alert" style="width:40%;"><?php echo $msg; ?></div>
					<?php } ?>
						<div class="panel panel-default">
						  <!-- Default panel contents -->
						  <div class="panel-heading">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
										<h4 class=" text-primary">Yearly Checklist</h4>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
										<a  href="add_yearly.php"><button style="float:right"class="btn btn-primary"><i class="fa fa-plus-circle" ></i> Add Yearly Maintenance</button></a>
									</div>
								</div>
							</div>
						  <div class="panel-body">
							<table class="table" width="100%">
							<tr>
								<th>#</th>
								<th>Maintenance</th>
								<th>Delete</th>
							</tr>
							<?php $c= 1;
							foreach($quarters as $veh){ ?>
							<tr>
								<td><?php echo $c; ?></td>
								<td><?php echo $veh['maintenance_name']; ?></td>
								<td>
									<a onclick="return confirm_alert(this);" href="yearly.php?del=<?php echo $veh['yearly_checklist_ID']; ?>" title="Delete Item" ><i class="fa fa-close" style="color:red;"></i></a>
								</td>
							</tr>
							<?php $c++; } ?>
						
						  </table>
						  </div>

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