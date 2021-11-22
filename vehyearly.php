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

	if (isset($_GET['vid'])){
		$veh_id = $_GET['vid'];
	}

	$post = false;
	$msg = "";
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		$post = true;
		if(isset($_POST['quarterly'])){
			$data = $_POST['quarterly'];
			$veh_id = $_POST['veh_id'];
			if ($qtr_main->add_vehilce_yrly_data($veh_id, $data)){
				header('location: vehicles.php?compat=8');
			}
		}else{
			$msg = "Select at least one item.";
		}
		
	}

	if (isset($_GET['del'])){
		$qtr_main->pk_value = addslashes($_GET['del']);
		if($qtr_main->remove()){
			header('location: quarterly.php?compat=3');
		}
	}

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
	<title>Process Yearly Checklist</title>
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
					<?php if($post){ ?>
						<div class="alert alert-info" role="alert" style="width:40%;"><?php echo $msg; ?></div>
					<?php } ?>
						<div class="panel panel-default">
						  <!-- Default panel contents -->
						  <div class="panel-heading">
								<div class="row">
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
										<h4 class=" text-primary">Process  Yearly Checklist</h4>
									</div>
									<div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
										
									</div>
								</div>
							</div>
						  <div class="panel-body">
						  <form action="" method="POST">
						  <input type="hidden" name="veh_id" value="<?php echo $veh_id; ?>" />
							<table class="table" width="100%">
							<tr>
								<th>Maintenance Type</th>
								<th>Status</th>
								<th>Remarks</th>
							</tr>
							<?php $c= 1;
							
							foreach($quarters as $veh){ ?>
							
							<tr>
								<td><?php echo $veh['maintenance_name']; ?></td>
								<td>
									
									<input type="checkbox" onclick="selectCheckbox(this)" value="<?php echo $veh['yearly_checklist_ID']; ?>" name="quarterly[<?php echo $veh['yearly_checklist_ID']; ?>]" value="" > Completed
								</td>
								<td><input type="text" disabled class="form-control" name="quarterly[<?php echo $veh['yearly_checklist_ID']; ?>]['remark'" placeholder="comments" /></td>
							</tr>
							<?php $c++; } ?>
							<tr>
								
								<td colspan="3" class="text-right">
									<button class="btn btn-primary">Save</button>
								</td>
							</tr>
						  </table>
						  </form>
						  </div>

						  <!-- Table -->
						  
						</div>
					</div>
					
					 
					 
				</div>
                <br />
				 
            </div>
        </div>
		<script>
			function selectCheckbox(elem){
				console.log(elem)
				if(elem.checked){
					
					$($(elem).parent().parent().children().children()[1]).prop('disabled', false);
					$($(elem).parent().parent().children().children()[1]).prop('required', true);
				}else{
					$($(elem).parent().parent().children().children()[1]).prop('disabled', true);
					$($(elem).parent().parent().children().children()[1]).prop('required', false);
				}
			}
		</script>
	
	<?php require_once('foot_inc.php'); ?>  
</body>
</html>