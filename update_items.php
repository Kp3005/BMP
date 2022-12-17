<?php

@include 'connection.php';

$id = $_GET['edit'];

if(isset($_POST['update_product'])){

    $product_name = $_POST['product_name'];
     $product_category = $_POST['product_category'];
     $product_image = $_FILES['product_image']['name'];
     $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
     $product_image_folder = 'images/'.$product_image;

   if(empty($product_name) || empty($product_category) || empty($product_image)){
      $message[] = 'please fill out all!';    
   }else{
      $try_query = mysqli_query($con,"SELECT * FROM category WHERE PID = '$id'");
      $data4 = mysqli_fetch_array($try_query);
     $pname= $data4['p_name'];


      $update_data = "UPDATE category SET p_name='$product_name', p_category='$product_category', p_img='$product_image'  WHERE PID = '$id'";
      $upload = mysqli_query($con, $update_data);
       
      if($upload){
         move_uploaded_file($product_image_tmp_name, $product_image_folder);
         // header('location:add_items.php');
      }else{
         $message[] = 'please fill out all!'; 
      }
      $message[] = 'Details updated Successfully!';  

     
      
      $update_data_currentTable = "UPDATE current SET product_name='$product_name', category='$product_category' WHERE product_name = '$pname'";
      $upload2 = mysqli_query($con, $update_data_currentTable);


      $qry = "INSERT INTO `categoryhistory`(`PID`, `p_category`, `p_name`, `p_img`, `last_date`, `status`) VALUES ('$id','$product_category','$product_name','$product_image',CURRENT_TIMESTAMP,'1')";
      $cnt_qry=mysqli_query($con, $qry);
   }
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="update_items.css">
</head>
<body>

<div class="navbar">
        <a class="active" href="admin.php" style="float: left; font-weight: 600; text-shadow: 15px; color:white ;">PricePared.com  </a>
        <!-- <button type="button" class="btnn"><a href="logout-user.php">Logout</a></button> -->
        <a href="admin.php">Back</a>
    </div>

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '<span class="message">'.$message.'</span>';
      }
   }
?>

<div class="container">


<div class="admin-product-form-container centered">

   <?php
      
      $select = mysqli_query($con, "SELECT * FROM category WHERE PID = '$id'");
      while($row = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">Update the product</h3>
      <input type="text" class="box" name="product_name" value="<?php echo $row['p_name']; ?>" placeholder="enter the product name">
      
      Product Category:
      <select name='product_category'>
                  <option selected disabled>--- Select ---</option>
                  <?php
                    $selectcat=mysqli_query($con,"select * from onlycategory");
                    while($datacat = mysqli_fetch_array($selectcat))
                    {
                    ?>
                        <option value="<?php echo $datacat['category']; ?>">  
                                         <?php echo $datacat['category'];?>  
                        </option>
                        <?php
                    }
                    ?>
                </select>


      <input type="file" class="box" name="product_image"  accept="image/png, image/jpeg,image/webp, image/jpg">
      <input type="submit" value="update product" name="update_product" class="btn">
      <!-- <a href="admin.php" class="btn">go back!</a> -->
   </form>
   


   <?php }; ?>

   

</div>

</div>

</body>
</html>