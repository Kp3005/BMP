<?php

require_once "controllerUserData.php";
?>

<?php
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    $fetch_info = mysqli_fetch_assoc($run_Sql);
 }
?>

<header class="header">

   <div class="flex">

      <a href="#" class="logo">PricePared</a>

      <nav class="navbar">
         <a href="customerpage.php">Home</a>
         <a href="customer_stores.php">View Products</a>
         <a href="order.php">My Orders</a>
         <a href="c_profile.php">Profile</a>
         <a href="login-user.php">Logout</a>
      </nav>
      

      <?php
      $cid=$fetch_info['No'];
      $select_rows = mysqli_query($con, "SELECT * FROM `cart` WHERE c_id='$cid'") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <a href="cart.php" class="cart">cart <span><?php echo $row_count; ?></span> </a>

      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>