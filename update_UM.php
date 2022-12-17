<?php

@include 'connection.php';

$umid = $_GET['edit'];

if(isset($_POST['update_detail'])){

    $u_name = $_POST['um_name'];
    $u_age = $_POST['um_age'];
    $u_contact = $_POST['um_contact'];
    $u_email = $_POST['um_email'];
    $u_password = $_POST['um_pwd'];

   if(empty($u_name) || empty($u_age) || empty($u_contact)||empty($u_email)|| empty($u_password)){
      $message[] = 'please fill out all!';    
   }else{
      $update_data = "UPDATE umtable SET u_name='$u_name', u_age='$u_age', u_contact='$u_contact', u_email='$u_email',u_password='$u_password' WHERE umid = '$umid'";
      $upload = mysqli_query($con, $update_data);
       


      if($upload){
        $message[] = 'Details updated Successfully! Kindly Check your E-Mail';  
     }else{
        $message[] = 'please fill out all!'; 
     }

     $subject = "PricePared.com UpdateManager Details";
        $message1 = "Hey $u_name, Your login password is $u_password, use this email: $u_email and given password for login.";
        $sender = "From: thekppatel@gmail.com";
        mail($u_email, $subject, $message1, $sender);
     
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
      
      $select = mysqli_query($con, "SELECT * FROM umtable WHERE umid = '$umid'");
      while($row2 = mysqli_fetch_assoc($select)){

   ?>
   
   <form action="" method="post" enctype="multipart/form-data">
      <h3 class="title">Update Details</h3>
      <input type="text" class="box" name="um_name" value="<?php echo $row2['u_name']; ?>" placeholder="enter name">
      <input type="text" class="box" name="um_age" value="<?php echo $row2['u_age']; ?>" placeholder="enter age">
      <input type="text" class="box" name="um_contact" value="<?php echo $row2['u_contact']; ?>" placeholder="enter contact number">
      <input type="text" class="box" name="um_email" value="<?php echo $row2['u_email']; ?>" placeholder="enter email">
      <input type="text" class="box" name="um_pwd" value="<?php echo $row2['u_password']; ?>" placeholder="enter password">

      <input type="submit" value="update details" name="update_detail" class="btn">
      <!-- <a href="admin.php" class="btn">go back!</a> -->
   </form>
   


   <?php }; ?>

   

</div>

</div>

</body>
</html>