<?php

@include 'connection.php';
$token = $_GET['see'];

?>




<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Counter_Pickup</title>

   
   <link rel="stylesheet" href="items_counter.css">
   <link rel="stylesheet" href="counter_pick.css">
   <!-- <link rel="stylesheet" href="css/cart_style.css"> -->

</head>
<body>



<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   

   <header>
      <a href="#" class="logo">PricePared</a>
      <div class="navigation">
        <ul class="menu">
          <div class="close-btn"></div>
          <li class="menu-item"><a href="deliveryboy_dashboard.php">Home</a></li>
          
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
    <br>
    <br>
<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Verify Token</h3>
      
         <input type="text" placeholder="enter token" name="token" class="box">
         <input type="submit" class="btn" name="view_order" value="Verify">
      </form>

   </div>

   


   <?php
   if(isset($_POST['view_order'])){
    $tokenvar=$_POST['token'];
    
    if($token == $tokenvar){
      $update_pass = "UPDATE order_pick SET status = 1 WHERE token = '$token'";
      $run_query = mysqli_query($con, $update_pass);
      //    echo "$xid";
      header('Location: accepted_order.php');
    }
    else{
      echo '<div style="background-color:#f69e10; padding:5px; font-size:22px; weight:200;"><center>Please enter Valif Token</center></div>';
 echo '<br>';
      header('Location: verify.php');
    }
}
?>

  


</body>
</html>




