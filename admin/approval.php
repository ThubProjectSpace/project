<!DOCTYPE HTML>
<html>
<head>
<title>Leave Approval</title>
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
  	
    <h3>LEAVE APPROVAL</h3>

    <!-- Bootstrap tabs -->
	
		      <h3 class="text-center">Permission</h3>
		        <!-- Daily Reports-->
			    <div class="row">
			      	<div class="col-md-12">
			      		<div class="table-responsive">
							<table class="table table-striped table-bordered table-hover">
								<thead>
									<tr class="warning">
										<th>S.No</th>
										<th>Staffid</th>
										<th>RFID</th>
										<th>First Name</th>
										<th>Last Name</th>
										<th>From Date</th>
								        <th>To Date</th>
								        <th>Date</th>
								        <th>Type of reason</th>
										<th>Reason</th>
						                <th>Action</th>
									</tr>
								</thead>
								<tbody>
					<?php	
						$date = date('Y-m-d');        
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
								<td><?php echo $fetch['from_date']; ?></td>
								<td><?php echo $fetch['to_date']; ?></td>
								<td><?php echo $date; ?></td>
				                <td><?php echo $fetch['type_of_reason']; ?></td>
				                <td><?php echo $fetch['reason']; ?></td>
				                <td><a href="approval.php?<?php echo base64_encode('sno'); ?>=<?php echo base64_encode($fetch['id']); ?>&action=approve" class="btn btn-info"><i class='fa fa-check'></i> Approve</a> <a href="#" onclick="return confirm('Are you Sure....');" class="btn btn-danger"><i class="fa fa-trash-o"></i> Deny</a></td>
							</tr>
						<?php
							$sno++;
			          	}
	    			?>
	    			if()						
					</tbody>
				</table>

	
								

</body>
</html>