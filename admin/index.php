<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Staff Attendance Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Open+Sans'>
  <link rel="stylesheet" href="css/style.min.css">
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  
  <?php
    include '../config/connection.php';
    if($_SESSION['id']!='' && $_SESSION['username']!=''){
      echo "<script>location='home.php'</script>";
    }
    if (isset($_POST['bt'])) {

      $uname = mysqli_real_escape_string($con, $_POST['us']);
      $pwd = mysqli_real_escape_string($con, $_POST['pw']);

      $query = "select * from users where username='".$uname."' AND password='".$pwd."'";
      $result = mysqli_query($con,$query);
      $fetch = mysqli_fetch_array($result);
      $count = mysqli_num_rows($result);
      if($count==1){
        $_SESSION['user_id']=$fetch['id'];
        $_SESSION['username']=$fetch['username'];
        $_SESSION['user_type'] = $fetch['usertype'];

        $result = mysqli_query($con, "select * from staff where staff_id='".$fetch['staff_id']."' ");
        $fetch = mysqli_fetch_array($result);
        $_SESSION['id'] = $fetch['id'];
        
        echo "<script>location.href='home.php';</script>";
      }
      else{
        echo "<script>alert('Login failed...');</script>";
      }
    }
  ?>
</head>
<body>
  <div class="cont">
    
     <form method="post">
     <div class="demo">
      <div class="login">
        <!-- <div class="login__check"></div> -->
        <div class="login__form">
        <h2 class="text-center">Login</h2>
          <div class="login__row">
            <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
              <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
            </svg>
            <input type="text" name="us" class="login__input name" placeholder="Username" required autofocus autocomplete="off" value="<?php echo $_POST['us']; ?>" />
          </div>
          <div class="login__row">
            <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
              <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
            </svg>
            <input type="password" name="pw" class="login__input pass" placeholder="Password" required />
          </div>
          <button type="submit" name="bt" class="login__submit">Sign in</button>
        </div>
      </div>
    </div>
    </form>
  </div>
</body>
</html>
