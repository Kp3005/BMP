<?php

@include 'connection.php';


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
          <li class="menu-item"><a href="countermanager.php">Home</a></li>
          
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
         <h3>Enter Customer Email Id</h3>
         <input type="text" placeholder="enter email" name="email" class="box">
         <input type="text" placeholder="enter token" name="token" class="box">
         <input type="submit" class="btn" name="view_order" value="Submit">
      </form>

   </div>

   


   <?php
  
   // if(empty($tokenvar)){
   if(isset($_POST['view_order'])){
      $tokenvar=$_POST['token'];
      $email=$_POST['email'];
      if(empty($email))
      {
         echo '<br>';
         echo '<br>';
         echo '<br>';
         //  echo "Please enter Email";
          echo '<div style="background-color:#f69e10; padding:5px; font-size:22px; weight:200;"><center>Please enter Email</center></div>';
   echo '<br>';
      }
      else if(empty($tokenvar)){

    
    $qry=  mysqli_query($con, "SELECT * FROM usertable where email='$email'");
    $qry1=mysqli_fetch_assoc($qry);
    $cid=$qry1['No'];
    ?>
    <div class="product-display">

<table class="product-display-table">
    <thead>
     <tr>
      <th>Order Detail</th>
      <th>Store</th>
      <th>Location</th>
      <th>Grand Total</th>
      <th>Order Date</th>
      <th>Token No.</th>
      <th>action</th>
</tr>
   </thead>
    <?php
    $select_order = mysqli_query($con, "SELECT * FROM order_pick where c_id='$cid'");
    
     
      
     
         while($fetch_cart=mysqli_fetch_array($select_order)) { ?>

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
            <!-- <td><input type="submit" name="pickup_btn" value="pickup"></td> -->
            <!-- <td> -->
                <!-- <button type="" name="counter_pick" value="Pick up"> -->
                 <!-- <a href="counter_pick.php?pickup=<?php echo $row['token']; ?>">  delete </a> -->
                 <!-- <input type="submit" class="btn" name="view_order" value="Submit"> -->
                 <!-- <form action="" method="post">
                 <input type="hidden" name="token" value="<?php echo $fetch_cart['token']; ?>">
                 <button type="submit" class="btn" name="view_order">Add to cart</button>
            </form?> -->
                          <!-- </td> -->
                          
                         
                          
            
            <td><a href="order_token.php?edit=<?php echo $fetch_cart['token']; ?>" class="btn"> Pick Up </a> </td>

            <?php 
            }
            ?>

           <?php 
            if($fetch_cart['status']=='1'){
            ?>
              <td>Picked Up Already</td>

            <?php 
            }
            ?>

        </tr>
         <?php
            }
        }
      else {

            // $email=$_POST['email'];
            $qry=  mysqli_query($con, "SELECT * FROM usertable where email='$email'");
            $qry1=mysqli_fetch_assoc($qry);
            $cid=$qry1['No'];
            ?>
            <div class="product-display">
        
        <table class="product-display-table">
            <thead>
             <tr>
              <th>Order Detail</th>
              <th>Store</th>
              <th>Location</th>
              <th>Grand Total</th>
              <th>Order Date</th>
              <th>Token No.</th>
              <th>action</th>
        </tr>
           </thead>
            <?php
            $select_order = mysqli_query($con, "SELECT * FROM order_pick where c_id='$cid' and token='$tokenvar'");
            
             
              
             
                 while($fetch_cart=mysqli_fetch_array($select_order)) { ?>
        
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
                    <!-- <td><input type="submit" name="pickup_btn" value="pickup"></td> -->
                    <!-- <td> -->
                        <!-- <button type="" name="counter_pick" value="Pick up"> -->
                         <!-- <a href="counter_pick.php?pickup=<?php echo $row['token']; ?>">  delete </a> -->
                         <!-- <input type="submit" class="btn" name="view_order" value="Submit"> -->
                         <!-- <form action="" method="post">
                         <input type="hidden" name="token" value="<?php echo $fetch_cart['token']; ?>">
                         <button type="submit" class="btn" name="view_order">Add to cart</button>
                    </form?> -->
                                  <!-- </td> -->
                                  
                                 
                                  
                    
                    <td><a href="order_token.php?edit=<?php echo $fetch_cart['token']; ?>" class="btn"> Pick Up </a> </td>
        
                    <?php 
                    }
                    ?>
        
                   <?php 
                    if($fetch_cart['status']=='1'){
                    ?>
                      <td>Picked Up Already</td>
        
                    <?php 
                    }
                    ?>
        
                </tr>
                 <?php
                    }
                };

      }
         ?>

      
      </table>
 
   </div>
    
    

    
   
</div>


</body>
</html>




