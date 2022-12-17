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
if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $cid=$fetch_info['No'];
   $update_quantity_query = mysqli_query($con, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id' AND c_id='$cid'");
   if($update_quantity_query){
      header('location:cart.php');
   };
};

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   $cid=$fetch_info['No'];
   mysqli_query($con, "DELETE FROM `cart` WHERE id = '$remove_id' AND c_id='$cid'");
   header('location:cart.php');
};

if(isset($_GET['delete_all'])){
   $cid=$fetch_info['No'];
   mysqli_query($con, "DELETE FROM `cart` WHERE c_id='$cid'");
   header('location:cart.php');
}

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
   <!-- <link rel="stylesheet" href="updatemanager.css"> -->

</head>
<body>

<!-- <header>
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
    </header> -->
    <?php include 'header.php'; ?>
<!-- <br>
<br>
<br>
<br> -->
<br>
<br>



<div class="container">

<section class="shopping-cart">

   <h1 class="heading">shopping cart</h1>

   <table>

      <thead>
         <th>image</th>
         <th>name</th>
         <th>store</th>
         <th>location</th>
         <th>price(INR)</th>
         <th>quantity</th>
         <th>total price(INR)</th>
         <th>action</th>
      </thead>

      <tbody>

         <?php 
         $cid=$fetch_info['No'];
         $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE c_id='$cid'");
         $grand_total = 0;
         if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
         ?>

         <tr>
            <td><img src="images/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td><?php echo $fetch_cart['store']; ?></td>
            <td><?php echo $fetch_cart['location']; ?></td>
            <td><?php echo $fetch_cart['price']; ?>/-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" >
                  <input type="submit" value="update" name="update_update_btn">
               </form>   
            </td>
            
            <td><?php echo $sub_total = $fetch_cart['price'] * $fetch_cart['quantity']; ?>/-</td>
            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
         </tr>
         <?php
         //   $grand_total = number_format($grand_total) + number_format($sub_total);  
         $grand_total+=$sub_total;
            };
         };
         ?>
         <tr class="table-bottom">
            <td><a href="customer_stores.php" class="option-btn" style="margin-top: 0;">continue shopping</a></td>
            <td colspan="5">grand total</td>
            <td><?php echo $grand_total; ?>/-</td>
            <td><a href="cart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">procced to checkout</a>
   </div>

</section>

</div>
   
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>