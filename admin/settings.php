<!DOCTYPE HTML>
<html>
<head>
<title>Staff Profile</title>
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

<script>
function myFunction() {
    var x = document.getElementById("myInput");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }
}
</script>
</head>
<body>
<div id="wrapper">
      <?php include 'includes/navbar.php';?>
        <div id="page-wrapper">
        <div class="col-md-12 graphs">
	   <div class="xs">
      <h3>Settings</h3>
		<?php
          if ($_GET['action']=='sett') {
            ?>
            <div class="alert alert-success alert-dismissible">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              <strong>Success!</strong> Password Updated Successfully.
            </div>
          <?php
          }
        ?>

      <div class="well1 white">
        <div class="col-md-6">
          <h3>Change User name</h3>
        <form method="post">
          <fieldset>
            <div class="form-group">
              <label class="control-label">Old Username</label>
              <input type="text" name="ous" class="form-control1" required autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">New Username</label>
              <input type="text" name="nus" class="form-control1" required autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Confirm Username</label>
              <input type="text" name="cus" class="form-control1"  id="myInput"  ng-pattern="/[0-9]/" required autocomplete="off">
            </div>           
            <div class="form-group">
              <button type="submit" name="bt1" class="btn btn-primary">Submit</button>
              <button type="reset" name="re" class="btn btn-default">Reset</button>
            </div>
          </fieldset>
        </form>
      </div>

  	    
         

             <div class="col-md-6">
              <h3>Change Password</h3>
        <form method="post">
          <fieldset>
            <!-- <div class="form-group">
              <label class="control-label">User Name</label>
              <input type="text" name="user" class="form-control1" required autocomplete="off">
            </div> -->
            <div class="form-group">
              <label class="control-label">Old Password</label>
              <input type="password" name="opw" class="form-control1" required autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">New Password</label>
              <input type="password" name="pw" class="form-control1" required autocomplete="off">
            </div>
            <div class="form-group">
              <label class="control-label">Confirm Password</label>
              <input type="password" name="cpw" class="form-control1"  id="myInput"  ng-pattern="/[0-9]/" required autocomplete="off">
                <label><input type="checkbox" onclick="myFunction()"> Show Password</label>
            </div>           
            <div class="form-group">
              <button type="submit" name="bt" class="btn btn-primary">Submit</button>
              <button type="reset" name="re" class="btn btn-default">Reset</button>
            </div>
          </fieldset>
        </form>
      </div>
      <div class="clearfix"></div>
    </div>
       
      </div>
        <?php 
        if (isset($_POST['bt'])) {  
          $sel_query="select password from users where id='".$_SESSION['user_id']."'";
          $sel_result=mysqli_query($con,$sel_query);
          $sel_fetch=mysqli_fetch_array($sel_result);
          if(mysqli_real_escape_string($con, $_POST['opw'])==$sel_fetch['password'])
          {
            if($_POST['pw']==$_POST['cpw']){
              $query = "update users set password='".$_POST['pw']."' where id='".$_SESSION['user_id']."'";
              $result = mysqli_query($con,$query);
              echo "<script>location.href='settings.php?action=sett';</script>";
            }
            else{
            echo "<script>alert('Enter correct password');</script>";
          }
          }
          else{
            echo "<script>alert('wrong password');</script>";
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