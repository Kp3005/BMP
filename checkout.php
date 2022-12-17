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

<?php
if(isset($_POST['order_btn'])){

   $cid=$fetch_info['No']; 
   $mail_data=[];
   
   $type=$_POST['delivery_type'];
   // $address = $_POST['address'];
   // if(empty($address) && $type == 1){
   //    $message[] = 'please fill out address';
   // }
   // else{
      $qry=mysqli_query($con, "SELECT * FROM `cart` WHERE c_id='$cid' GROUP BY store,location");
      if(mysqli_num_rows($qry) > 0){
         while($data = mysqli_fetch_assoc($qry)){

            $store=$data['store'];
            $location=$data['location'];


            $cart_query = mysqli_query($con, "SELECT * FROM `cart` WHERE c_id='$cid' AND store='$store' AND location='$location'");
            $price_total = 0;
            if(mysqli_num_rows($cart_query) > 0){
               while($product_item = mysqli_fetch_assoc($cart_query)){
                  $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
                  $product_price = $product_item['price'] * $product_item['quantity'];
                  $price_total += $product_price;
               };
            };
            $rand_id= rand(10000,99999);
            $total_product = implode(', ',$product_name);
            $detail_query = mysqli_query($con, "INSERT INTO `order_pick`(`c_id`, `c_name`, `total`, `store`, `location`, `o_date`, `status`, `delivery_status`,`delivery_type`,`feedback`, `token`) VALUES ('$cid','$total_product','$price_total','$store','$location',current_timestamp,'0','0','$type','0','$rand_id' )") or die('query failed');
            $product_name=[];

            $mail_data[] = $store.' '.$location.' (' .$rand_id. ' ) ';
            
            }
      }
   // }

   
   $final_msg = implode(', ',$mail_data);
   


   // if($cart_query && $detail_query){
   //    echo "
   //    <div class='order-message-container'>
   //    <div class='message-container'>
   //       <h3>thank you for shopping!</h3>
   //       <div class='order-detail'>
   //          <span>".$total_product."</span>
   //          <span class='total'> total : $".$price_total."/-  </span>
   //       </div>
   //       <div class='customer-details'>
   //          <p> your name : <span>".$name."</span> </p>
   //          <p> your number : <span>".$number."</span> </p>
   //          <p> your email : <span>".$email."</span> </p>
   //          <p> your address : <span>".$flat.", ".$street.", ".$city.", ".$state.", ".$country." - ".$pin_code."</span> </p>
   //          <p> your payment mode : <span>".$method."</span> </p>
   //          <p>(*pay when product arrives*)</p>
   //       </div>
   //          <a href='products.php' class='btn'>continue shopping</a>
   //       </div>
   //    </div>
   //    ";
   // }

   mysqli_query($con, "DELETE FROM `cart` WHERE c_id='$cid'");


   

   $qry1=mysqli_query($con, "SELECT * FROM `usertable` WHERE email='$email'");
   $data3= mysqli_fetch_assoc($qry1);
   $cname=$data3['name'];

   $subject = "PricePared.com Order Detail";
   $message = "Hey $cname, Your order has been placed successfully. Kindly note down your order Details: $final_msg";
   $sender = "From: thekppatel@gmail.com";
                    if(mail($email, $subject, $message, $sender)){
                        echo "send successfully";
                    }else{
                        echo "Failed while sending code!";
                    }
   


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/cart_style.css">

</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<section class="checkout-form">

   <h1 class="heading">complete your order</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
      $cid=$fetch_info['No'];
         $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE c_id='$cid'");
         $total = 0;
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      }else{
         echo "<div class='display-order'><span>your cart is empty!</span></div>";
      }
      ?>
      <span class="grand-total"> grand total : <?= $grand_total; ?>/- </span>
   </div>

   <!-- <input type="radio" class="btn-check" name="delivery_type" id="sp" autocomplete="off" checked>
   <label class="btn btn-secondary" for="option1">Self pick-up</label>

   <input type="radio" class="btn-check" name="delivery_type" id="od" autocomplete="off" checked>
    <label class="btn btn-secondary" for="option1">Deliver at Home</label> -->


   <input type="radio" value="0" name="delivery_type" class="btn"> self pick-up
   <input type="radio" value="1" name="delivery_type" class="btn"> Deliver at Home
   <br>
<br> 
  

      <input type="submit" value="order now" name="order_btn" class="btn">
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>