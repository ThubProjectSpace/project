<!DOCTYPE HTML>
<html>
<head>
<title>Leave Application</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
  include 'includes/links.html';
  include '../config/connection.php';
  if ($_SESSION['id']=='' || $_SESSION['username']=='') {
      echo "<script>location.href='/project/admin/'</script>";
    }
?>
<!-- Bootstrap Core JavaScript -->
<link href="datepicker/css/datepicker.css" rel="stylesheet">
<script src="datepicker/js/bootstrap-datepicker.js"></script>
<script src="js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrapper">
	
      <?php 
          $date = date('Y-m-d');
          $sel_query = "select * from staff where id='".$_SESSION['id']."'";
          $sel_result = mysqli_query($con, $sel_query);
          $sel_fetch = mysqli_fetch_array($sel_result);
      ?>
      <?php include 'includes/navbar.php';?>
        <div id="page-wrapper">
        <div class="col-md-12 graphs">
	   <div class="xs">
  	    <h3>Leave Application</h3>

  	     <?php
          if ($_GET['alert']==5) {
            ?>
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong><br/> Leave applied successfully....
            </div>
          <?php
          }
          else if ($_GET['alert']==6) {
            ?>
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>failed...</strong>
            </div>
          <?php
          }
        ?>
  	    <div class="well1 white">
            <form method="post">
              <fieldset>
                <div class="form-group">
                  <label class="control-label normal">Staff Id</label>
                  <input type="text"  name="staff" class="form-control1" required="" autofocus readonly value="<?php echo $sel_fetch['staff_id'];?>">
                </div>
                 <div class="form-group">
                  <label class="control-label normal">RFID</label>
                  <input type="text"  name="rf" class="form-control1" required="" autofocus readonly value="<?php echo $sel_fetch['rf_id'];?>">
                </div>
                <div class="form-group">
                  <label class="control-label">First Name</label>
                  <input type="text" name="fname" class="form-control1" required autocomplete="off" value="<?php echo $sel_fetch['firstname'];?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Last Name</label>
                  <input type="text" name="lname" class="form-control1" required autocomplete="off" value="<?php echo $sel_fetch['lastname'];?>">
                </div>
                <div class="row">
                <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">From:</label>
                      <div class="form-group input-group date" id="from_date" data-date-format="yyyy-mm-dd">
                         <input class="form-control" type="text" name="date1" id="from_date" required readonly>
                         <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                      </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                  <label class="control-label">To:</label>
                      <div class="form-group input-group date" id="to_date" data-date-format="yyyy-mm-dd">
                         <input class="form-control" type="text" name="date2" id="to_date" required readonly>
                         <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                      </div>
                  </div>
              </div>
              </div>
              <div class="form-group">
                  <label class="control-label">Date</label>
                      <div class="form-group input-group date" id="date" data-date-format="yyyy-mm-dd">
                         <input type="text" name="date" class="form-control1" readonly autocomplete="off" value="<?php echo $date;?>">
                      </div>
                  </div>
                <div class="form-group">
                  <label class="control-label">Type of leave</label>
                  <select class="form-control1" name="type">
                  <option value="">Select</option>
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">Others</option>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label">Reason</label>
                  <textarea name="reason" class="form-control1" rows="6" required ></textarea>
                </div>         
                <div class="form-group">
                  <button type="submit" name="bt" class="btn btn-primary">Submit</button>
                  <button type="reset" name="re" class="btn btn-default">Reset</button>
                </div>
              </fieldset>
            </form>
         <?php

           if (isset($_POST['bt'])){
            
              if ($_POST['staff']==$sel_fetch['staff_id']) {
             
              
            $query = "insert into leave_perm set staff_id='".$_POST['staff']."',rf_id='".$_POST['rf']."',firstname='".$_POST['fname']."',lastname='".$_POST['lname']."',from_date='".$_POST['date1']."',to_date='".$_POST['date2']."',date='".$_POST['date']."',type_of_reason='".$_POST['type']."',reason='".$_POST['reason']."',status='1'";

            $result = mysqli_query($con,$query);
        		}

           if($result){
            echo "<script>location.href='leave.php?alert=5';</script>";
          }

          else{

            echo "<script>location.href='leave.php?alert=6';</script>";
              }
           }
         
         


         ?>

          <div class="clearfix"></div>
      </div>
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
    $("#from_date").datepicker({ 
          autoclose: true, 
          todayHighlight: true
    });
  });
</script>
<script>
	$(function () {
		$("#to_date").datepicker({
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
