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


    // if($_GET['action']=='profile'){
    $sel_query = "select * from staff where id='".$_SESSION['id']."' ";
    $sel_result = mysqli_query($con, $sel_query);
    $fetch = mysqli_fetch_array($sel_result);
    // }

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
        <h3>Profile</h3>
        <?php
          if ($_GET['alert']==3) {
            ?>
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong><br/> Profile updated successfully....
            </div>
          <?php
          }
          else if ($_GET['alert']==4) {
            ?>
            <div class="alert alert-danger alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Profile updation failed...</strong>
            </div>
          <?php
          }
        ?>
        <div class="well1 white">
        <form method="post" enctype="multipart/form-data">
          <fieldset>
            <div class="form-group">
              <label class="control-label normal">Staff Id</label>
              <input type="text"  name="st" class="form-control1" required="" autofocus readonly value="<?php echo $fetch['staff_id']; ?>">
            </div>
            <div class="form-group">
                  <label class="control-label normal">RFID</label>
                  <input type="text"  name="rf" class="form-control1" required="" autofocus readonly value="<?php echo $fetch['rf_id'];?>">
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
              <input type="number" name="pn" class="form-control1" ng-pattern="/[0-9]/" required autocomplete="off" value="<?php echo $fetch['phone']; ?>">
            </div>
            <div class="form-group">
              <label class="control-label">Email</label>
              <input type="email"  name="em" class="form-control1" required="" autocomplete="off" value="<?php echo $fetch['email']; ?>">
            </div>
            <div class="form-group">
              <strong class="control-label">Current Profile</strong><br/>
              <?php
                  $filename = 'images/users/'.$fetch['profile'];
                  if($fetch['profile']=="") {
                      $fetch['profile'] = 'user.png';
                  }
                  if (!file_exists($filename)) {
                      $fetch['profile'] = 'user.png';
                  }
              ?>
              <img src="images/users/<?php echo $fetch['profile']; ?>" class="img-responsive img-thumbnail img-rounded" width="80" draggable="false" /><br/>
              <strong class="control-label">Change New</strong>
              <input type="file"  name="profile" class="form-control1">
            </div>
            <div class="form-group">
              <label class="control-label">College</label>
              <input type="text"  name="co" class="form-control1" required="" autocomplete="off" value="<?php echo $fetch['college']; ?>">
            </div>
            <div class="form-group">
              <label class="control-label">Address</label>
              <textarea name="ad" class="form-control1" rows="6" required ><?php echo $fetch['address']; ?></textarea>
            </div> 
            <button type="submit" name="update" class="btn btn-primary" >Update</button>           
          </fieldset>
        </form>
      </div>
        <?php 
          if (isset($_POST['update'])) {

            $first_name = mysqli_real_escape_string($con, $_POST['fn']);
            $last_name = mysqli_real_escape_string($con, $_POST['ln']);
            $staff_id = mysqli_real_escape_string($con, $_POST['st']);
            $rfid = mysqli_real_escape_string($con, $_POST['rf']);
            $phone = mysqli_real_escape_string($con, $_POST['pn']);
            $email = mysqli_real_escape_string($con, $_POST['em']);
            $college = mysqli_real_escape_string($con, $_POST['co']);
            $address = mysqli_real_escape_string($con, $_POST['ad']);
            $img = $_FILES['profile'];

            if ($img['name']!="") {
              $ext = pathinfo($img['name'], PATHINFO_EXTENSION);
              if ($ext!='png' && $ext!='jpg' && $ext!='jpeg') {
                echo "error";
              }
              else {
                $target = 'images/users/';
                $temp_name = $img['tmp_name'];
                $img_name = $_SESSION['id'].'.jpg';
                $move = move_uploaded_file($temp_name, $target.$img_name);

                if ($move) {
                  $query = "update staff set profile='".$img_name."' where id='".$_SESSION['id']."'";
                  $result = mysqli_query($con,$query);
                }
              }
            }

            $query = "update staff set rf_id='".$rfid."', firstname='".$first_name."', lastname='".$last_name."',phone='".$phone."',email='".$email."',college='".$college."',address='".$address."',status='1' where id='".$_SESSION['id']."'";
            $result = mysqli_query($con,$query);
            if($result){


            echo "<script>location.href='profile.php?alert=3';</script>";
          }
          else {
           echo "<script>location.href='profile.php?alert=4';</script>";
         }
          
          }
        
        ?>
      </div>
    </div>
    
   </div>
      </div>
      <!-- /#page-wrapper -->
   </div>
   <?php include 'includes/footer.html'; ?>
    <!-- /#wrapper -->
<!-- Nav CSS -->
<link href="css/custom.css" rel="stylesheet">
<!-- Metis Menu Plugin JavaScript -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
</body>
</html>
