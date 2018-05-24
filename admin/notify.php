<!DOCTYPE HTML>
<html>
<head>
<title>Staff Details</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
  include 'includes/links.html';
  include '../config/connection.php';
    if ($_SESSION['id']=='' || $_SESSION['username']=='') {
      echo "<script>location.href='/project/admin/'</script>";
    }
?>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrapper">
        <?php include 'includes/navbar.php'; ?>
        <div id="page-wrapper">
        <div class="col-md-12 graphs">
	   <div class="xs">
  	<?php
if ($_SESSION['user_type']=='admin') {
	
?>
      <h3>Leave Notifications</h3>

      <div class="row">
      	<div class="col-md-12">
      		<div class="table-responsive">
				<table class="dataTable table table-striped table-bordered table-hover">
					<thead>

						<tr class="warning">
							<th>S.No</th>
			                <th>Staff id</th>
			                <th>RFID</th>
			                <th>First Name</th>
							<th>Last Name</th>
							<th>Date</th>
			                <th>Type of Leave</th>
			                <th>Reason</th>
			                <th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php	        
			            $query = "select * from leave_perm ";
			            $result = mysqli_query($con,$query);
			            $count = mysqli_num_rows($result);
			            $sno = 1;
			          	while($fetch = mysqli_fetch_array($result)) {
			          	?>
							<tr>
								<td><?php echo $sno; ?></td>
								<td><?php echo $fetch['staff_id']; ?></td>
								<td><?php echo $fetch['rf_id']?></td>
								<td><?php echo $fetch['firstname']; ?></td>
								<td><?php echo $fetch['lastname']; ?></td>
								<td><?php echo $fetch['date']; ?></td>
				                <td><?php echo $fetch['type_of_reason']; ?></td>
				                <td><?php echo $fetch['reason']; ?></td>
				                <td><a href="#" class="btn btn-info"><i class='fa fa-check'></i> Approve</a> <a href="#" onclick="return confirm('Are you Sure....');" class="btn btn-danger"><i class="fa fa-trash-o"></i> Deny</a></td>
							</tr>
						<?php
							$sno++;
			          	}
	    			?>						
					</tbody>
				</table>
			</div>
		</div>
  	</div>
 <?php
}
?>

   </div>
      </div>
      <!-- /#page-wrapper -->
   </div>
    <?php  include 'includes/footer.html';?>
    <!-- /#wrapper -->
<!-- Nav CSS -->
<link href="css/custom.css" rel="stylesheet">
<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
