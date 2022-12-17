<?php require_once "controllerUserData.php"; 
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




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update_Manager</title>
    <link rel="stylesheet" href="updatemanager.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
    <title><?php echo $fetch_info['u_name'] ?> Update manager panel</title>
  </head>
  <body>

    <header>
      <a href="#" class="logo">PricePared</a>
      <div class="navigation">
        <ul class="menu">
          <div class="close-btn"></div>
          <li class="menu-item"><a href="#">Home</a></li>

          <li class="menu-item"><a href="um_store.php">Stores</a></li>
          
          <li class="menu-item"><a href="um_edit_price.php">Edit Price</a></li>

          <li class="menu-item"><a href="um_profile.php">Profile</a></li>
          <li class="menu-item"><a href="login-user.php">Logout</a></li>
        </ul>
      </div>
      <div class="menu-btn"></div>
    </header>


   
    
    <section class="section-home">
    <h1>Welcome <?php echo $fetch_info['u_name'] ?></h1>
    <!-- <h1> Update Manager page</h1> -->
      <!-- <h1>Update Manager Page</h1> -->
    </section>
    

  </body>
</html>

      