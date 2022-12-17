<?php

@include 'connection.php';

if(isset($_POST['Submit'])){

   $email= $_POST['email'];
  // $product_price = $_POST['product_price'];
  

   if(empty($email)){
      $message[] = 'please fill out all';
   }
};



?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="items.css">

</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<span class="message">'.$message.'</span>';
   }
}

?>
   
<div class="container">

   <div class="admin-product-form-container">

      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
         <h3>Add a new product</h3>
         <input type="text" placeholder="enter email" name="email" class="box">
         <!-- <input type="text" placeholder="enter product category" name="product_category" class="box">
         <input type="file" accept="image/png, image/jpeg, image/webp, image/jpg" name="product_image" class="box"> -->
         <input type="submit" class="btn" name="Submit" value="Submit">
      </form>

   </div>

   <?php

   $select = mysqli_query($con, "SELECT * FROM usertable");
   
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
         <?php while($row = mysqli_fetch_assoc($select)){ ?>
         <tr>
            <td><img src="images/<?php echo $row['p_img']; ?>" height="100" alt=""></td>
            <td><?php echo $row['p_name']; ?></td>
            <td><?php echo $row['p_category']; ?></td>
            <td>
               <a href="update_items.php?edit=<?php echo $row['PID']; ?>" class="btn"> <i class="fas fa-edit"></i> edit </a>
               <a href="add_items.php?delete=<?php echo $row['PID']; ?>" class="btn"> <i class="fas fa-trash"></i> delete </a>
            </td>
         </tr>
      <?php } ?>
      </table>
   </div>
</div>


</body>
</html>