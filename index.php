<!DOCTYPE html>
<html>
	<head>
	<title>Project</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
     <link rel="stylesheet" type="text/css" href="css/style.css">
     <link href="https://fonts.googleapis.com/css?family=Do+Hyeon|PT+Sans" rel="stylesheet">

	<?php
	include 'config/connection.php';
	$count = 1;
	if (isset($_POST['submit'])) {		
		$query = "select * from staff where rf_id='".$_POST['user']."'";
		$result = mysqli_query($con,$query);
		$fetch = mysqli_fetch_array($result);
		$count = mysqli_num_rows($result);
		$date = date('Y-m-d');
		$time = date('h:i:s a');

		if ($count==1) {
			$sel_query = "select * from attendance where staff_id='".$fetch['staff_id']."' AND date='".$date."'";
			$sel_result = mysqli_query($con,$sel_query);
			$sel_fetch = mysqli_fetch_array($sel_result);
			$sel_count = mysqli_num_rows($sel_result);
			
			if($sel_count==0){
				$ins_query = "insert into attendance set staff_id='".$fetch['staff_id']."',rf_id='".$_POST['user']."', date='".$date."',in_time='".$time."'";
				$ins_result= mysqli_query($con,$ins_query);
			}
			else if (date('H:i:s')>'12:05:00') {
				$upd_query = "update attendance set out_time='".$time."' where staff_id='".$fetch['staff_id']."' AND date='".$date."' ";
				$upd_result = mysqli_query($con, $upd_query);
			}
		}
	}
	?>
	<style>
	#example1 {
    background: url(images/img.jpg) right bottom no-repeat;
}
</style>
	</head>
<body>
	<div class="container" id="example1">
		<div class="row">
			<div class="col-md-12 col-xs-12">
				<div class="welcome_note text-center">
		    		<h3>Welcome to Technical hub</h3>
				</div>
				<p><marquee><h3 class="text-info">Please tap your RFID....</h3></marquee></p><br/> 
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 staff_details">
				<div class="well well-lg text-center">
						<?php 
							if ($count==0) {
								echo "<h3 class='text-center text-danger'>Staff Details Not found...</h3>";
							}							
						?>
						<img src="images/preview.jpg" class="img img-responsive img-thumbnail preview_img" alt="preview" width="180
						" >
					<h4>DETAILS</h4>
					<table class="table">
						<tbody>
							<tr>
								<td>Id</td>
								<td>:</td>
								<td><label><?php echo @$fetch['staff_id']; ?></label></td>
							</tr>
							<tr>
								<td>Name</td>
								<td>:</td>
								<td><label><?php echo @$fetch['firstname']; ?></label></td>
							</tr>
							<tr>
								<td>College</td>
								<td>:</td>
								<td><?php echo @$fetch['college']; ?></td>
							</tr>
							<tr>
								<td>Email</td>
								<td>:</td>
								<td><?php echo @$fetch['email']; ?></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="col-md-6">
				<form method="post">
					<div class="well well-lg text-center">
						<h2>TAP HERE</h2><br/>
						<input type="text" name="user" class="form-control" placeholder="RFID" autofocus autocomplete="off"><br/>
						<button class="btn btn-primary" type="submit" name="submit">Scan</button>
			        </div>
		        </form>
		        <div class="well well-lg text-center" style="padding: 0 0 10px 0;">
		        	<h3>Today Staff</h3>
		        	<?php
						$query_p = "select * from attendance where date='".date('Y-m-d')."' ";
						$result_p = mysqli_query($con,$query_p);
						$present = mysqli_num_rows($result_p);

						$query_t = "select * from staff";
						$result_t = mysqli_query($con,$query_t);
						$count_t = mysqli_num_rows($result_t);

						$absent = $count_t-$present;
		        	?>
		        	<div class="col-md-6" style="border-right: 1px solid #888;">
		        		<h1 class="text-success"><?php echo $present; ?></h1>
		        		<h3>Present</h3>
		        	</div>

		        	<div class="col-md-6">
		        		<h1 class="text-danger"><?php echo $absent;?></h1>
		        		<h3>Absent</h3>
		        	</div>
		        	

		        	<div class="clearfix"></div>
		        </div>
		    </div>
		</div>
	</div>
	
</body>
</html>
