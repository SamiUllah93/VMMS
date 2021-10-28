
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

	 <div id="page-content-wrapper">
            <div class="container-fluid">
				
				<div class="row">
					
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 box" style="padding-top:10px;">
						<span style="font-size:0.95em;color:#449D44;"><b>Add New Vehicle</b></span>
						<hr />
						<form method="POST" action="" name="addprodform" id="addprodform" >
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>BA.NO</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								
								<input type="text" class="form-control" name="title" placeholder="RLA-4565"  required  />
							</div>
							
						</div>
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Make </b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								
								<input type="text" class="form-control" name="title" placeholder="Suzuki,Toyota,Honda"  required  />
							</div>
							
						</div>
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Type </b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								
								<input type="text" class="form-control" name="title" placeholder="Car,Jeep,Truck"  required  />
							</div>
							
						</div>
						
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Year of Manufacturer</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								
								<input type="text" class="form-control" name="title" placeholder="2010,2011,2012"  required  />
							</div>
							
						</div> 
						<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Driver</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
								<select name="DealersId"  class="form-control" required >
									<option value="" selected disabled >Select Driver</option>
									<option>Asif</option>
									<option>Ghafoor</option>
									<option>Ahsan</option>
									<option>Chohan</option>
								</select>
							</div>
							
						</div>
							<div class="row" style="padding-top:10px;">
							<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12" style="padding-top:6px;text-align:right;">
								<b>Type of Maintainance</b>
							</div>
							<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
							
								<b>Engine Oil </b> <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck"> 
									<div  id="ifYes" style="visibility:hidden">
										Running <input class="form-control" type='text' id='yes' name='yes'><br><br>
										Time Period <input class="form-control" type='text' id='acc' name='acc'>
									</div>
									
									<b>Oil Filter Change <b> <input type="radio" onclick="javascript:yesnoCheck();" name="yesno" id="yesCheck"> 
									<div id="ifYes" >
										Running <input class="form-control" 'text' id='yes' name='yes'><br><br>
										Time Period <input class="form-control" type='text' id='acc' name='acc'>
									</div>
									<br>
									<b>Air Filter Cleaning <b> <input type="radio"  name="yesno" id="yesCheck"> 
									<div id="ifYes" >
										Running <input class="form-control" type='text' id='yes' name='yes'><br><br>
										Time Period <input class="form-control" type='text' id='acc' name='acc'>
									</div>
								</div>
							</div>
							</div>
						
						
						</form>
						<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
					</div>
					
					 
					 
				</div>
                <br />
				 
            </div>
        </div>
		
	
	<?php require_once('foot_inc.php'); ?>  
</body>
<script type="text/javascript">

function yesnoCheck() {
    if (document.getElementById('yesCheck').checked) {
        document.getElementById('ifYes').style.visibility = 'visible';
    }
    else document.getElementById('ifYes').style.visibility = 'hidden';

}

</script>
</html>