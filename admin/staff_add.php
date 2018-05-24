<!DOCTYPE HTML>
<html>
<head>
<title>Staff Registration</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
  include 'includes/links.html';
  include '../config/connection.php';
  if ($_SESSION['id']=='' || $_SESSION['username']=='') {
      echo "<script>location.href='/project/admin/'</script>";
    }

    if ($_GET['action']=='EditStaff') {
      $id = mysqli_real_escape_string($con, $_GET[base64_encode('sno')]);
      $row_id = base64_decode($id);

      $sel_query = "select * from staff where id='".$row_id."' ";
      $sel_result = mysqli_query($con, $sel_query);
      $count = mysqli_num_rows($sel_result);
      $fetch = mysqli_fetch_array($sel_result);
    }
    

?>
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</head>
<body>
<div id="wrapper">
      <?php include 'includes/navbar.php';?>
        <div id="page-wrapper">
        <div class="col-md-12 graphs">
	   <div class="xs">
      <?php
if ($_SESSION['user_type']=='admin') {
  
?>
  	    <h3>Staff Registration</h3>

        <?php
          if ($_GET['alert']==1) {
            ?>
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong><br/> New Staff Added Successfully.
            </div>
          <?php
          }
          else if ($_GET['alert']==2) {
            ?>
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Staff adding failed...</strong>
            </div>
          <?php
          }
        ?>
        <?php
          if ($_GET['alert']=='bulk1') {
            ?>
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong><br/> Bulk upload success..
            </div>
          <?php
          }
          else if ($_GET['alert']=='bulk2') {
            ?>
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Upload failed...</strong>
            </div>
          <?php
          }
        ?>
        <?php
          if (isset($_POST['bt'])) {
          if ($_GET['action']=='EditStaff') {
            ?>
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong><br/> Updated Successfully.
            </div>
          <?php
          }
          else if ($_GET['action']=='EditStaff') {
            ?>
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>update failed...</strong>
            </div>
          <?php
          }
        }
        ?>

  	    <div class="well1 white">
          <div class="col-md-6">
            <h3 class="text-center"><i><b>Staff Add</b></i></h3>
            <form method="post">
              <fieldset>
                <div class="form-group">
                  <label class="control-label normal">Staff Id</label>
                  <input type="text"  name="st" class="form-control1" readonly required="" autofocus value="<?php echo $fetch['staff_id']; ?>" autocomplete="off">
                </div>
                <div class="form-group">
                  <label class="control-label normal">RFID</label>
                  <input type="number"  name="rf" class="form-control1" readonly required="" autofocus value="<?php echo $fetch['rf_id']; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label normal">Confirm RFID</label>
                  <input type="number"  name="crf" class="form-control1" required="" autofocus value="<?php echo $fetch['rf_id']; ?>">
                
                </div>
                
                <div class="form-group">
                  <label class="control-label">First Name</label>
                  <input type="text" name="fn" class="form-control1" required autocomplete="off" value="<?php echo $fetch['firstname']; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Last Name</label>
                  <input type="text" name="ln" class="form-control1" required autocomplete="off" value="<?php echo $fetch['lastname']; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Phone Number</label>
                  <input type="text" maxlength="10" minlength="10" name="pn" class="form-control1" required autocomplete="off" value="<?php echo $fetch['phone']; ?>" onkeypress="return ((event.charCode>=48 && event.charCode<=57) || event.charCode==0);">
                </div>
                <div class="form-group">
                  <label class="control-label">Email</label>
                  <input type="email"  name="em" class="form-control1" required="" autocomplete="off" value="<?php echo $fetch['email']; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">College</label>
                  <input type="text"  name="co" class="form-control1" required="" autocomplete="off" value="<?php echo $fetch['college']; ?>">
                </div>
                <div class="form-group">
                  <label class="control-label">Address</label>
                  <textarea name="ad" class="form-control1" rows="6" required ><?php echo $fetch['address']; ?></textarea>
                </div>            
                <div class="form-group">
                  <button type="submit" name="bt" class="btn btn-primary"><?php if ($_GET['action']=='EditStaff'){ echo 'Update'; } else { echo 'Submit'; } ?></button>
                  <button type="reset" name="re" class="btn btn-default">Reset</button>
                </div>
              </fieldset>
            </form>
          </div>

          <div class="col-md-6">
            <h3 class="text-center"><b><i>Staff Bulk Upload</i></b></h3>
            <form method="post" enctype="multipart/form-data">
                <strong>CSV file Should be like this </strong><a href="images/csv_format.png" target="new"><img src="images/csv_format.png" width="40%" class="img-responsive" /></a><br/><br/>
                <div class="form-group">
                  <label class="control-label">Choose CSV file</label>
                  <input type="file"  name="csv" class="form-control1" required="" autocomplete="off" value="<?php echo $fetch['email']; ?>">
                </div>

                <div class="form-group">
                  <button type="submit" name="upload_btn" class="btn btn-primary">Upload</button>
                </div>
            </form>

          </div>

          <div class="clearfix"></div>
      </div>
      <?php
      }
      ?>
        <?php 
        if (isset($_POST['bt'])) {
          $firstname = mysqli_real_escape_string($con, $_POST['fn']);
          $lastname = mysqli_real_escape_string($con, $_POST['ln']);
          $staff_id = mysqli_real_escape_string($con, $_POST['st']);
          $rfid = mysqli_real_escape_string($con, $_POST['rf']);
          $phone = mysqli_real_escape_string($con, $_POST['pn']);
          $email = mysqli_real_escape_string($con, $_POST['em']);
          $college = mysqli_real_escape_string($con, $_POST['co']);
          $address = mysqli_real_escape_string($con, $_POST['ad']);

          $id = mysqli_real_escape_string($con, $_GET[base64_encode('sno')]);
          $row_id = base64_decode($id);

          if ($_GET['action']=='EditStaff') {
            $query = "update staff set rf_id='".$rfid."',firstname='".$firstname."',lastname='".$lastname."',phone='".$phone."',email='".$email."',college='".$college."',address='".$address."',staff_id='".$staff_id."',status='1' where id='".$row_id."'";
            $result = mysqli_query($con,$query);
            echo "<script>location.href='staff_add.php';</script>";
          }
          else if($_POST['rf']==$_POST['crf']) {
            $query = "insert into staff set rf_id='".$rfid."',firstname='".$firstname."',lastname='".$lastname."',phone='".$phone."',email='".$email."',college='".$college."',address='".$address."',staff_id='".$staff_id."',status='1'";
            $result = mysqli_query($con,$query);

            $query = "insert into users set rf_id='".$rfid."', staff_id='".$staff_id."', username='".$staff_id."', password='".$staff_id."' , usertype='employee' ,status='1'";
            $result = mysqli_query($con,$query);

            if ($result) {
              echo "<script>location.href='staff_add.php?alert=1';</script>"; 
            }
            else {
              echo "<script>location.href='staff_add.php?alert=2';</script>";
            }
          }
          else{
            echo "<script>alert('wrong RFID');</script>";
          }
        }  


        if (isset($_POST['upload_btn'])) {
          //print_r($_FILES['csv']);
          //echo $_FILES['csv']['name'];
          $csv = $_FILES['csv'];
          $ext = pathinfo($csv['name'], PATHINFO_EXTENSION);
          if ($ext=='csv') {
            $filename = $csv['name'];
            $tmp_name = $csv['tmp_name'];

            $file_open = fopen($tmp_name, r);

            while (($getData = fgetcsv($file_open, 10000, ",")) !== FALSE) {
              //print_r($getData);
              //echo "<br/>";
              $query = "insert into staff set staff_id='".$getData['0']."', rf_id='".$getData['1']."', name='".$getData['2']."', phone='".$getData['3']."', email='".$getData['4']."', gender='".$getData['5']."', branch='".$getData['6']."', year='".$getData['7']."', college='".$getData['8']."', project_name='".$getData['9']."', address='".$getData['10']."',status='1'";
              $result = mysqli_query($con, $query);



              $query1 = "insert into users set rf_id='".$getData['1']."', staff_id='".$getData['0']."', username='".$getData['0']."', password='".$getData['0']."' , usertype='employee' ,status='1'";
            $result1 = mysqli_query($con,$query1);




              if ($result) {
                echo "<script>location.href='staff_add.php?alert=bulk1'</script>";
              }
              else{
                echo "<script>location.href='staff_add.php?alert=bulk2'</script>";

              }
            }

            fclose($file_open);
          }
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
<link href="css/custom.css" rel="stylesheet">
<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
