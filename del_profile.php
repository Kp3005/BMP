<?php require_once "controllerUserData.php"; 
?>

<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM delivery_boy WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    $fetch_info = mysqli_fetch_assoc($run_Sql);
 }
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="updatemanager.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 300px;
  margin: auto;
  text-align: center;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}
</style>
    <title>Document</title>
</head>
<body>




<header>
      <a href="#" class="logo">PricePared</a>
      <div class="navigation">
        <ul class="menu">
          <div class="close-btn"></div>
          <li class="menu-item"><a href="deliveryboy_dashboard.php">Home</a></li>

          <li class="menu-item"><a href="avi_order.php">Available Orders</a></li>
          
          <li class="menu-item"><a href="accepted_order.php">Accepted Orders</a></li>

          <li class="menu-item"><a href="del_profile.php">Profile</a></li>
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


<div class="card">
  <img src="avatar.svg" alt="John" style="width:100%">
  <h1><?php echo $fetch_info['name']; ?></h1>
  <p class="title"><?php echo $fetch_info['email']; ?></p><br>
  
   <?php
   $id = $fetch_info['d_id'];
      $city = "SELECT * FROM delivery_boy WHERE d_id='$id'";
      $run_Sql1 = mysqli_query($con, $city);
      $fetch_info1 = mysqli_fetch_assoc($run_Sql1);
   ?>


  <a href="#"><i class="fa fa-dribbble"></i></a>
  <a href="#"><i class="fa fa-twitter"></i></a>
  <a href="#"><i class="fa fa-linkedin"></i></a>
  <a href="#"><i class="fa fa-facebook"></i></a>
  <p><button>Edit Profile</button></p>
</div>
</body>
</html>