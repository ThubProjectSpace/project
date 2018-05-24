<!DOCTYPE HTML>
<html>
<head>
<title>users</title>
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
      <h3>USER DETAILS</h3>
 
      <div class="row">
      	<div class="col-md-12">
      		<div class="table-responsive">
				<table class="dataTable table table-striped table-bordered table-hover">
					<thead>

						<tr class="warning">
							<th>S.No</th>
							<th>Staff Id</th>
							<th>RFID</th>
							<th>Username</th>
							<th>Usertype</th>
			                <th>Status</th>
			                <th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php	        
			            $query = "select * from users";
			            $result = mysqli_query($con,$query);
			            $count = mysqli_num_rows($result);
			            $inc = 0;
			          	while($fetch = mysqli_fetch_array($result)) {
			          		$inc++;
			          	?>
							<tr>
								<td><?php echo $inc; ?></td>
								<td><?php echo $fetch['staff_id']; ?></td>
								<td><?php echo $fetch['rf_id']; ?></td>
								<td><?php echo $fetch['username']; ?></td>
								<td><?php echo $fetch['usertype']; ?></td>
				                <td><?php echo $fetch['status']; ?></td>
				                <td><a href="users.php?action=UserDelete&<?php echo base64_encode('sno'); ?>=<?php echo base64_encode($fetch['id']); ?>" onclick="return confirm('Are you Sure....');" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</a></td>
							</tr>
						<?php
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
    <?php  include 'includes/footer.html';  ?>
    <!-- /#wrapper -->
<!-- Nav CSS -->
<link href="css/custom.css" rel="stylesheet">
<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>