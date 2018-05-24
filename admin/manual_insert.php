<!DOCTYPE HTML>
<html>
<head>
<title>Manual Insertion</title>
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
      <?php include 'includes/navbar.php';?>
        <div id="page-wrapper">
        <div class="col-md-12 graphs">
	   <div class="xs">
  	    <h3>Attendance</h3>
  	    <div class="well1 white">
        <form method="post">
          <fieldset>
            <div class="form-group">
              <label class="control-label normal">Staff Id</label>
              <input type="number"  name="st" class="form-control1" required="" autofocus value="">
            </div>
             <div class="form-group">
                  <label class="control-label normal">RFID</label>
                  <input type="number"  name="rf" class="form-control1" required="" autofocus readonly value="">
                </div>
            <div class="form-group">
                  <label class="control-label">Date</label>
                      <div class="form-group input-group date" id="date" data-date-format="yyyy-mm-dd">
                         <input type="text" name="date" class="form-control1" readonly autocomplete="off" value="<?php echo date('Y-m-d');?>">
                      </div>
                  </div>
            <div class="form-group">
              <label class="control-label">In Time</label>
              <input type="time" name="intime" class="form-control1" required autocomplete="off" value="">
            </div>            
            <div class="form-group">
              <button type="submit" name="bt" class="btn btn-primary">Submit</button>
              <button type="reset" name="re" class="btn btn-default">Reset</button>
            </div>
          </fieldset>
        </form>
      </div>
      <?php 

        if (isset($_POST['bt'])) {
           
          $query = "insert into attendance set staff_id='".$_POST['st']."',rf_id='".$_POST['rf']."',date='".$_POST['date']."',in_time='".$_POST['intime']."'";
          $result = mysqli_query($con,$query);


        }

      ?>
    </div>
    </div>
    <?php include 'includes/footer.html'; ?>
   </div>
      </div>
      <!-- /#page-wrapper -->
   </div>
    <!-- /#wrapper -->
<!-- Nav CSS -->
<script>
  $(function () {
    $("#from_date_div").datepicker({ 
          autoclose: true, 
          todayHighlight: true
    });
  });
</script>
<link href="css/custom.css" rel="stylesheet">
<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
