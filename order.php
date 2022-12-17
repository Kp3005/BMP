<?php

require_once "controllerUserData.php";
// require_once "connection.php";
?>




<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/cart_style.css">
   <link rel="stylesheet" href="vieworder.css">

</head>
<body>

<header>
      <a href="#" class="logo">PricePared</a>
      <div class="navigation">
        <ul class="menu">
          <div class="close-btn"></div>
          <li class="menu-item"><a href="customerpage.php">Home</a></li>
          <li class="menu-item"><a href="c_profile.php">Profile</a></li>
          <li class="menu-item"><a href="customer_stores.php">Back</a></li>
          <li class="menu-item"><a href="login-user.php">Logout</a></li>
         
          

      
      <div id="menu-btn" class="fas fa-bars"></div>
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



<div class="container">

<section class="shopping-cart">

   <h1 class="heading">My Orders</h1>
    
   <table>

      <thead>
         <th>Order Detail</th>
         <th>Store</th>
         <th>Location</th>
         <th>Grand Total</th>
         <th>Order Date</th>
         <th>Token No.</th>
         <th>Status</th>
         <th>Feedback</th>
      </thead>

      <tbody>

         <?php 
         // $cid=$fetch_info['No'];
         $select_cart = mysqli_query($con, "SELECT * FROM `order_pick` order by o_date desc");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><?php echo $fetch_cart['c_name']; ?></td>
            <td><?php echo $fetch_cart['store']; ?></td>
            <td><?php echo $fetch_cart['location']; ?></td>
            <td><?php echo $fetch_cart['total']; ?>/-</td>
            <td><?php echo $fetch_cart['o_date']; ?></td>
            <td><?php echo $fetch_cart['token']; ?></td>
           
            <!-- <td><a href="order_token.php?edit=<?php echo $fetch_cart['token']; ?>" class="btn"> Pick Up </a> </td> -->
            <?php 
            if($fetch_cart['status']=='0'){
            ?>
            <!-- <td><a href="order_token.php?edit=<?php echo $fetch_cart['token']; ?>" class="btn"> Pick Up </a> </td> -->
            <td><?php echo "Not Picked Up"?></td>
            <?php 
            }
            ?>

           <?php 
            if($fetch_cart['status']=='1'){
            ?>
            <!-- <td><a href="order_token.php?edit=<?php echo $fetch_cart['token']; ?>" class="btn"> Pick Up </a> </td> -->
            <td><?php echo "Picked Up"?></td>
            <?php 
            }
            ?>

            
            <!-- -------------------------FEEDBACK----------------------------- -->
            
            <!-- <td><a href="order_token.php?edit=<?php echo $fetch_cart['token']; ?>" class="btn"> Pick Up </a> </td> -->
            <?php 
            if($fetch_cart['status']=='0'){
            ?>
            <!-- <td><a href="order_token.php?edit=<?php echo $fetch_cart['token']; ?>" class="btn"> Pick Up </a> </td> -->
            <td><?php echo "Not Picked Up"?></td>
            <?php 
            }
            ?>

           <?php 
            if($fetch_cart['status']=='1'  && $fetch_cart['feedback']=='0'){
            ?>
            <!-- <td><a href="order_token.php?edit=<?php echo $fetch_cart['token']; ?>" class="btn"> Pick Up </a> </td> -->
            <td>
            <a href="feedback.php?edit=<?php echo $fetch_cart['token']; ?>" class="btn">  Give Feedback </a>
                           
            </td>
            <?php 
            }
            ?>

            <?php 
            if($fetch_cart['status']=='1'  && $fetch_cart['feedback']!='0'){
            ?>
            <!-- <td><a href="order_token.php?edit=<?php echo $fetch_cart['token']; ?>" class="btn"> Pick Up </a> </td> -->
            <td><?php echo "Feedback saved successfully"?></td>
            <?php 
            }
            ?>
            

            

        </tr>
         <?php
            }
         }
         ?>
         

      </tbody>

   </table>

   


</section>

</div>
   
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>