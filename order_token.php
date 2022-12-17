<?php

// @include 'config.php';
// require_once "controllerUserData.php";
@include 'connection.php';
?>

<?php

$token = $_GET['edit'];
?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Header Navigation Menu With Dropdowns</title>
    <link rel="stylesheet" href="order_token.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
    <title>token_check</title>
  </head>
  <body>

    <header>
      <a href="#" class="logo">PricePared</a>
      <div class="navigation">
        <ul class="menu">
          <div class="close-btn"></div>
          <li class="menu-item"><a href="counter_pick.php">Back</a></li>
          <li class="menu-item"><a href="login-user.php">Logout</a></li>
        </ul>
      </div>
      <div class="menu-btn"></div>
    </header>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<?php

   // $token = $_GET['edit'];
   $qry = "SELECT * FROM order_pick WHERE token = '$token'";
   $qry2=mysqli_query($con,$qry);
   $data = mysqli_fetch_assoc($qry2);

   if($data) {
   $o_date=$data['o_date'];
   //$o_dt= date(strtotime($o_date. ' + 2 days'));
   $o_dt=date('Y-m-d', strtotime($o_date. ' + 2 days'));
   //echo "$o_date ";
  // echo '<br>';
  // echo "$o_dt";
   $c_date = date("Y-m-d H:i:s"); 
  // echo "$c_date";
   if($c_date<=($o_dt)){

   
   // if(($c_date)<=($o_date+2)) {
      $try_query1 = mysqli_query($con,"UPDATE order_pick SET status='1' WHERE token='$token'");
   //   $data5 = mysqli_fetch_assoc($try_query1);
   echo '<div style="background-color:#f69e10; padding:10px; font-size:36px; weight:500;"><center>Order Pickedup Successfully</center></div>';
   echo '<br>';
  // echo '<div style="background-color:#52b350; padding:10px; font-size:26px; weight:500;"><center>Date: </center></div>' .$c_date;
   //echo "$c_date";
   ?>
   <center><?php echo "Date: " .$c_date;?></center>
   <?php
      // echo "Order Pickedup Successfully";
      // $message[] = 'Order Pickedup Successfully';
   }
   else {
      echo '<div style="background-color:#52b350; padding:10px; font-size:26px; weight:500;"><center>Oops!! Token Expired</center></div>';
      // echo "Token Expired";
      // $message[] = 'Token Expired'; 
   }
   }
   else {
      echo 'error';
   }

?>
   
   
   
    
    
    

  </body>
</html>