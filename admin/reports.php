<!DOCTYPE HTML>
<html>
<head>
<title>Reports</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
  include 'includes/links.html';
  include '../config/connection.php';
    if ($_SESSION['id']=='' || $_SESSION['username']=='') {
      echo "<script>location.href='/project/admin/'</script>";
    }
?>
<link href="datepicker/css/datepicker.css" rel="stylesheet">
<script src="datepicker/js/bootstrap-datepicker.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrapper">
        <?php include 'includes/navbar.php'; ?>
        <div id="page-wrapper">
        <div class="col-md-12 graphs">
	   <div class="xs">
  	
    <h3>ATTENDANCE DETAILS</h3>

    <!-- Bootstrap tabs -->
	<div class="container">
	  <ul class="nav nav-tabs nav-justified">
	  <li class="<?php if(!$_POST) echo 'active'; ?>"><a data-toggle="tab" href="#day">Daily</a></li>
	  <li><a data-toggle="tab" href="#week">Weekly</a></li>
	  <li><a data-toggle="tab" href="#month">Monthly</a></li>
	  <li class="<?php if($_POST) echo 'active'; ?>"><a data-toggle="tab" href="#custom">Custom</a></li>
	  </ul>

		<div class="tab-content">
		    <div id="day" class="tab-pane fade <?php if(!$_POST) echo 'active in'; ?>">
		      <h3 class="text-center">Daily Reports</h3>
		        <!-- Daily Reports-->
			    <div class="row">
			      	<div class="col-md-12">
			      		<div class="table-responsive">
							<table class="dataTable table table-striped table-bordered table-hover">
								<thead>
									<tr class="warning">
										<th>S.No</th>
										<th>Staffid</th>
										<th>RFID</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Phone</th>
								        <th>Email</th>
								        <th>College</th>
										<th>Date</th>
						                <th>In Time</th>
						                <th>Out Time</th>
									</tr>
								</thead>
								<tbody>
								<?php	
								    $date=date('Y-m-d');

								    if ($_GET['action']=='viewreports') {
								    	$i = $_GET[base64_encode('sno')];
    									$i = base64_decode($i);
								        $query = "select * from attendance where staff_id='".$i."' AND date='".$date."'";
								    }
								    else if($_SESSION['user_type']=='employee'){
								    	 $query = "select * from attendance where staff_id='".$_SESSION['id']."' AND date='".$date."'";
								    }
								    else {   
						            	$query = "select * from attendance where date='".$date."'";
						        	}
						            $result = mysqli_query($con,$query);
						            $count = mysqli_num_rows($result);
						            $id= 0;
						          	while($fetch = mysqli_fetch_array($result)) {
						          		$id++;
						          		$sel_query="select * from staff where staff_id='".$fetch['staff_id']."'";
						          		$sel_result=mysqli_query($con,$sel_query);
						          		$sel_fetch=mysqli_fetch_array($sel_result);

						          	?>
										<tr>
											<td><?php echo $id;?></td>
											<td><?php echo $fetch['staff_id']; ?></td>
											<td><?php echo $sel_fetch['rf_id']; ?></td>
											<td><?php echo $sel_fetch['firstname']; ?></td>
											<td><?php echo $sel_fetch['lastname']; ?></td>
											<td><?php echo $sel_fetch['phone']; ?></td>
							                <td><?php echo $sel_fetch['email']; ?></td>
							                <td><?php echo $sel_fetch['college']; ?></td>
											<td><?php echo $fetch['date']; ?></td>
							                <td><?php echo $fetch['in_time']; ?></td>
							                <td><?php echo $fetch['out_time']; ?></td>
							                <?php
							            }
							        	
							            ?>
										</tr>					
								</tbody>
							</table>
						</div>
					</div>
			  	</div>
			  	<!-- /daily reports -->
		    </div>
		    <div id="week" class="tab-pane fade">
		      <h3 class="text-center">Weekly Reports</h3>
		      <?php
				$presentdate = date('Y-m-d');
				$date_week = date("W",strtotime($presentdate));
				$date_year = date("Y",strtotime($presentdate));
				$currentweek = date("W");

				$week = getWeek($date_week,$date_year);
				function getWeek($week, $year) {
				  $dto = new DateTime();
				  $result['start'] = $dto->setISODate($year, $week, 0)->format('Y-m-d');
				  $result['end'] = $dto->setISODate($year, $week, 6)->format('Y-m-d');
				  return $result;
				}

				// echo $week['start']."<br/>";
				// echo $week['end']."<br/>";
		      ?>
		         <!-- weekly reports -->
			    <div class="row">
			      	<div class="col-md-12">
			      		<div class="table-responsive">
							<table class="dataTable table table-striped table-bordered table-hover">
								<thead>
									<tr class="warning">
										<th>S.No</th>
										<th>Staffid</th>
										<th>RFID</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Phone</th>
								        <th>Email</th>
								        <th>College</th>
										<th>Date</th>
						                <th>In Time</th>
						                <th>Out Time</th>
									</tr>
								</thead>
								<tbody>
								<?php
									if ($_GET['action']=='viewreports') {
								    	$i = $_GET[base64_encode('sno')];
    									$i = base64_decode($i);
								        $query = "select * from attendance where staff_id='".$i."'";
								    }
								    else { 	        
						            $query = "select * from attendance where date BETWEEN '".$week['start']."' AND '".$week['end']."'";
						            }
						            $result = mysqli_query($con,$query);
						            $count = mysqli_num_rows($result);
						            $id= 0;
						          	while($fetch = mysqli_fetch_array($result)) {
						          		$id++;
						          		$sel_query="select * from staff where staff_id='".$fetch['staff_id']."'";
						          		$sel_result=mysqli_query($con,$sel_query);
						          		$sel_fetch=mysqli_fetch_array($sel_result);

						          	?>
										<tr>
											<td><?php echo $id;?></td>
											<td><?php echo $fetch['staff_id']; ?></td>
											<td><?php echo $sel_fetch['rf_id']; ?></td>
											<td><?php echo $sel_fetch['firstname']; ?></td>
											<td><?php echo $sel_fetch['lastname']; ?></td>
											<td><?php echo $sel_fetch['phone']; ?></td>
							                <td><?php echo $sel_fetch['email']; ?></td>
							                <td><?php echo $sel_fetch['college']; ?></td>
											<td><?php echo $fetch['date']; ?></td>
							                <td><?php echo $fetch['in_time']; ?></td>
							                <td><?php echo $fetch['out_time']; ?></td>
							                <?php
							            }
							            ?>
										</tr>					
								</tbody>
							</table>
						</div>
					</div>
			  	</div> 
			  	<!-- /weekly reports -->
		    </div>
		    <div id="month" class="tab-pane fade">
		      <h3 class="text-center">Monthly Reports</h3>
		      <?php
		      	//echo date('t');
		      	$month_start = date('Y-m-').'01';
		      	$month_end = date('Y-m-t');
		      ?>		      
		         <!-- monthly reports -->
			    <div class="row">
			      	<div class="col-md-12">
			      		<div class="table-responsive">
							<table class="dataTable table table-striped table-bordered table-hover">
								<thead>
									<tr class="warning">
										<th>S.No</th>
										<th>Staffid</th>
										<th>RFID</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Phone</th>
								        <th>Email</th>
								        <th>College</th>
										<th>Date</th>
						                <th>In Time</th>
						                <th>Out Time</th>
									</tr>
								</thead>
								<tbody>
								<?php
									if ($_GET['action']=='viewreports') {
								    	$i = $_GET[base64_encode('sno')];
    									$i = base64_decode($i);
								        $query = "select * from attendance where staff_id='".$i."'";
								    }
								    else { 	        
						            $query = "select * from attendance where date BETWEEN '".$month_start."' AND '".$month_end."'";
						        	}
						            $result = mysqli_query($con,$query);
						            $count = mysqli_num_rows($result);
						            $id= 0;
						          	while($fetch = mysqli_fetch_array($result)) {
						          		$id++;
										$sel_query="select * from staff where staff_id='".$fetch['staff_id']."'";
						          		$sel_result=mysqli_query($con,$sel_query);
						          		$sel_fetch=mysqli_fetch_array($sel_result);

						          	?>
										<tr>
											<td><?php echo $id;?></td>
											<td><?php echo $fetch['staff_id']; ?></td>
											<td><?php echo $sel_fetch['rf_id']; ?></td>
											<td><?php echo $sel_fetch['firstname']; ?></td>
											<td><?php echo $sel_fetch['lastname']; ?></td>
											<td><?php echo $sel_fetch['phone']; ?></td>
							                <td><?php echo $sel_fetch['email']; ?></td>
							                <td><?php echo $sel_fetch['college']; ?></td>
											<td><?php echo $fetch['date']; ?></td>
							                <td><?php echo $fetch['in_time']; ?></td>
							                <td><?php echo $fetch['out_time']; ?></td>
							                <?php
							            }
							            ?>
										</tr>					
								</tbody>
							</table>
						</div>
					</div>
			  	</div>
			  	<!-- /monthly reports-->
		    </div>
		 
		    <div id="custom" class="tab-pane fade <?php if($_POST) echo 'active in'; ?>">
		      <h3 class="text-center">Custom Reports</h3>
		      	<div class="text-center">
			         <form method="post">
			         	<div class="col-md-3 col-md-offset-3">
			         		<label>From : </label>
			                <div class="form-group input-group date" id="from_date_div" data-date-format="yyyy-mm-dd">
			                   <input class="form-control" type="text" name="date1" id="from_date" required readonly>
			                   <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
			                </div>
			            </div>
			            <div class="col-md-3">
			            	<label>To : </label>
			                <div class="form-group input-group date" id="to_date_div" data-date-format="yyyy-mm-dd">
			                   <input class="form-control" type="text" name="date2" id="to_date" required readonly>
			                   <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
			                </div>
			            </div><br/>
				      	<!-- From:<input type="date" name="date1">
				      	To:<input type="date" name="date2"> -->
				      	<div class="clearfix"></div>
				      	<button class="btn btn-info" name="go">Go</button>
				    </form>
			    </div>
		      <?php
		         
		      
		      if(isset($_POST['go'])){

		      	$date1=$_POST['date1'];
		        $date2=$_POST['date2'];
		      	$sel2_query = "select * from attendance where date BETWEEN '".$date1."' AND '".$date2."' ";
				$sel2_result = mysqli_query($con,$sel2_query);			    
		      
		      ?>
		      <div class="table-responsive">
							<table class="dataTable table table-striped table-bordered table-hover">
								<thead>
									<tr class="warning">
										<th>S.No</th>
										<th>Staffid</th>
										<th>RFID</th>
										<th>Date</th>
						                <th>In Time</th>
						                <th>Out Time</th>
									</tr>
								</thead>
								<tbody>
								<?php	        
						   
						            $id= 0;
						          	while($sel2_fetch = mysqli_fetch_array($sel2_result)) {
						          	$id++;
						          		
 								?>
										<tr>
											<td><?php echo $id;?></td>
											<td><?php echo $sel2_fetch['staff_id']; ?></td>
											<td><?php echo $sel2_fetch['rf_id']; ?></td>
											<td><?php echo $sel2_fetch['date']; ?></td>
							                <td><?php echo $sel2_fetch['in_time']; ?></td>
							                <td><?php echo $sel2_fetch['out_time']; ?></td>
							                <?php
							            }
							         }
							            ?>
										</tr>					
								</tbody>
							</table>
						</div>
		    </div>
		    
	    </div>
	<!-- Bootsrap tabs -->
</div>
</div>
   </div>
      </div>
      <!-- /#page-wrapper -->
   </div>
   <?php  include 'includes/footer.html';  ?>
</div>
    <!-- /#wrapper -->

<script>
  $(function () {
    $("#from_date_div").datepicker({ 
          autoclose: true, 
          todayHighlight: true
    });
  });

  $(function () {
    $("#to_date_div").datepicker({
          autoclose: true, 
          todayHighlight: true
    });
  });
</script>

</body>
</html>