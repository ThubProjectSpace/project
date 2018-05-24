<!DOCTYPE HTML>
<html>
<head>
<title>Profile</title>
  <meta charset="utf-8">
<meta name="viewport" content="width=device-width">
<?php
    include 'includes/links.html';
    include '../config/connection.php';
    if ($_SESSION['id']=='' || $_SESSION['username']=='') {
      echo "<script>location.href='/project/admin/'</script>";
    }
?>

</head>
<body>

        <?php
            include 'includes/navbar.html'; 
        ?>
        <div id="page-wrapper">
        <div class="col-md-12 graphs">
     <div class="xs">
        <div class="container ">
        <h3 class="text-center">Profile</h3>
          <h4>DETAILS</h4>
          <div class="well1 white">
        <form method="post">
        <?php 
           
        $query = "select * from staff where id='".$_SESSION['id']."'";
        $result = mysqli_query($con,$query);
        $fetch = mysqli_fetch_array($result);
        $count = mysqli_num_rows($result);
      
        ?>
          <fieldset>
            <table class="table table-responsive">
            <tbody>
              <tr>
                <td>Staff Id</td>
                <td>:</td>
                <td><label><?php echo @$fetch['staff_id']; ?></label></td>
              </tr>
              <tr>
                <td>First Name</td>
                <td>:</td>
                <td><label><?php echo @$fetch['firstname']; ?></label></td>
              </tr>
              <tr>
                <td>Last Name</td>
                <td>:</td>
                <td><label><?php echo @$fetch['lastname']; ?></label></td>
              </tr>
              <tr>
                <td>Phone</td>
                <td>:</td>
                <td><label><?php echo @$fetch['phone']; ?></label></td>
              </tr>
              <tr>
                <td>Email</td>
                <td>:</td>
                <td><label><?php echo @$fetch['email']; ?></label></td>
              </tr>
              <tr>
                <td>College</td>
                <td>:</td>
                <td><?php echo @$fetch['college']; ?></td>
              </tr>
              <tr>
                <td>Address</td>
                <td>:</td>
                <td><label><?php echo @$fetch['address']; ?></label></td>
              </tr>
            </tbody>
          </table>
          </fieldset>
        </form>
      </div>
        </div>
            <?php include('includes/footer.html'); ?>
      </div>
      </div>
      </div>

  
    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <!----Calender -------->
    <link rel="stylesheet" href="css/clndr.css" type="text/css" />
    <script src="js/underscore-min.js" type="text/javascript"></script>
    <script src= "js/moment-2.2.1.js" type="text/javascript"></script>
    <script src="js/clndr.js" type="text/javascript"></script>
    <script src="js/site.js" type="text/javascript"></script>
    <!----End Calender -------->    
</body>
</html>










<div class="col-md-4 span_4">
              <div class="cloud">
                <div class="grid-date">
                    <div class="date">
                        <p class="date-in">India</p>
                        <span class="date-on">°F °C </span>
                        <div class="clearfix"> </div>                           
                    </div>
                    <h4>30<i class="fa fa-cloud-upload"> </i></h4>
                </div>
                <p class="monday"><?php echo $day;?></p>
              </div>
            </div>