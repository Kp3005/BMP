
<?php require_once "controlleruserData.php"; 
?>

<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM umtable WHERE u_email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    $fetch_info = mysqli_fetch_assoc($run_Sql);
 }
?>


<?php
$pid = $_GET['editprice'];

if(isset($_POST['update_price'])){


   $sltm="SELECT * FROM category WHERE PID='$pid'";
      $sltm2= mysqli_query($con,$sltm);
      $row3 = mysqli_fetch_array($sltm2);
      $nm1=$row3['p_name'];

    $p_name = $_POST['p_name'];
    $p_cat = $_POST['p_cat'];
    $p_price = $_POST['p_price'];
    $mall_id= $fetch_info['umid'];

   if(empty($p_name) || empty($p_price)){
      $message[] = 'please fill out all!';    
   }else{
      $update_data = "UPDATE current SET price='$p_price' WHERE mall_id = '$mall_id' AND product_name='$nm1'";
      $upload = mysqli_query($con, $update_data);
       
      if($upload){
        $message[] = 'Price updated Successfully!';  
     }else{
        $message[] = 'please fill out all!'; 
     }

     $qry = "INSERT INTO `history`(`No`, `mall_id`, `category`, `product_name`, `price`, `date`) VALUES ('','$mall_id','$p_cat','$p_name','$p_price',CURRENT_TIMESTAMP)";
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
        <a href="um_edit_price.php">Back</a>
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
      
      $slt="SELECT * FROM category WHERE PID='$pid'";
      $slt2= mysqli_query($con,$slt);
      $row3 = mysqli_fetch_array($slt2);

      $nm=$row3['p_name'];
      $mall_id1= $fetch_info['umid'];
      $select = mysqli_query($con, "SELECT * FROM current WHERE  product_name='$nm' AND mall_id='$mall_id1'");
      while($row2 = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">Update Price</h3>
      <input type="text" class="box" name="p_name" value="<?php echo $row2['product_name']; ?>" placeholder="Product name">
      <input type="text" class="box" name="p_cat" value="<?php echo $row2['category']; ?>" placeholder="Category">
      <input type="text" class="box" name="p_price" value="<?php echo $row2['price']; ?>" placeholder="enter price">
      

      <input type="submit" value="update details" name="update_price" class="btn">
      <!-- <a href="admin.php" class="btn">go back!</a> -->
   </form>
   


   <?php }; ?>

   

</div>

</div>

</body>
</html>