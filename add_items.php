<?php

@include 'connection.php';

if(isset($_POST['add_product'])){

   $product_name = $_POST['product_name'];
  // $product_price = $_POST['product_price'];
   $product_category = $_POST['product_category'];
   $product_image = $_FILES['product_image']['name'];
   $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
   $product_image_folder = 'images/'.$product_image;

   if(empty($product_name) || empty($product_category) || empty($product_image)){
      $message[] = 'please fill out all';
   }else{
      //$insert = "INSERT INTO category(p_name, p_category, p_image) VALUES('$product_name', '$product_category', '$product_image')";
      $insert = "INSERT INTO `category`(`PID`, `p_category`, `p_name`, `p_img`) VALUES ('', '$product_category','$product_name','$product_image')";
      $upload = mysqli_query($con,$insert);
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         $message[] = 'new product added successfully';
      }else{
         $message[] = 'could not add the product';
      }
   }

};

if(isset($_GET['delete'])){
   $id = $_GET['delete'];
   mysqli_query($con, "DELETE FROM category WHERE PID = $id");
   header('location:add_items.php');
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
         <input type="text" placeholder="enter product name" name="product_name" class="box">
         <input type="text" placeholder="enter product category" name="product_category" class="box">
         <input type="file" accept="image/png, image/jpeg, image/webp, image/jpg" name="product_image" class="box">
         <input type="submit" class="btn" name="add_product" value="add product">
      </form>

   </div>

   <?php
   $select = mysqli_query($con, "SELECT * FROM category");
   ?>
   <div class="product-display">
      <table class="product-display-table">
         <thead>
         <tr>
            <th>product image</th>
            <th>product name</th>
            <th>product category</th>
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