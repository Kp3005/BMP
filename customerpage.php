<?php 
require_once "controllerUserData.php"; 
// require_once "connection.php"; 
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

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to PricePared.com/customer page</title>
    <link rel="stylesheet" href="updatemanager.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>
  </head>
  <body>


  <style>
  
  /* Current/active navbar link */
  .active {
    background-color: #eab029;
    text-shadow: 2px 2px 4px #000000;
    
  }
  @media screen and (max-width: 500px) {
    .navbar a {
      float: none;
      display: block;
    }
  }
.container {
  position: relative;
  text-align: center;
  color: white;
}

.centered {
  position: absolute;
  top: 80%;
  left: 50%;
  transform: translate(-50%, -50%);
}

img{
  border: solid 2px black;
}


button{
  background-color: white;
  padding: 20px;
  border: solid 3px black;
  cursor: pointer;
  border-radius: 10%;
}
a{
  text-decoration: none;
  color: black;
  font-size: x-large;
  text-shadow: 2px 2px 5px rgb(191, 190, 190);
  font-weight: bold;
  font-family: Georgia;
}

button:hover {
    background-color:rgb(255, 208, 0) ;
}

.column {
  float: left;
 /* width: 33.33%; */
  padding: 50px;
}
.column:hover{
  transform: scale(1.3);
}

/* Clear floats after image containers */
.row::after {
  content: "";
  clear: both;
  display: table;
  padding: 10px;
}

h1{
  text-shadow: 2px 2px 5px rgb(139, 138, 138);
}

.foo{
    background-color: #333; 
    height: 50px;
    color: white; 
    text-align: center; 
    font-weight: lighter;
    font-size: 15px;
}


</style>

    <header>
      <a href="#" class="logo">PricePared</a>
      <div class="navigation">
        <ul class="menu">
          <div class="close-btn"></div>
          <li class="menu-item"><a href="MAIN_FRONT.html">Home</a></li>
          <li class="menu-item"> <a href="nearbyme.php">Near by Shops</a></li>
          <!-- <li class="menu-item">
            <a class="sub-btn" href="#">City <i class="fas fa-angle-down"></i></a>
            <ul class="sub-menu">
              <li class="sub-item"><a href="customer_stores.php">Ahmedabad</a></li>
              <li class="sub-item"><a href="customer_stores2.php">Mumbai</a></li>
            </ul>
          </li> -->

        

          


          <!-- <li class="menu-item"><a href="">Products</a></li> -->
          <!-- <li class="menu-item"><a href="navtrial2.html">About</a></li> -->
          <li class="menu-item"> <a href="order.php">My Orders</a></li>
          <li class="menu-item"> <a href="customer_analytics.php">Analytics</a></li>
          <li class="menu-item"><a href="c_profile.php">Profile</a></li>
          <li class="menu-item"><a href="login-user.php">Logout</a></li>
        </ul>
      </div>
      <div class="menu-btn"></div>
    </header>
    <br>
    <br>
    <br>
    <br>

    <h1 style="padding:50px; text-align:center;">Welcome to Customer's page</h1>
    <br>
    <h2 style="text-align:center" style="padding:40px; color:yellow">TOP CATEGORIES WE OFFER</h2>

    <section class="section-home">
   
<div class="row" style="margin-left: 1%;">
<div class="column">
    <div class="container">
       <img src="images/11.webp" alt="Dals" style="width:300px; height: 300px;">
        <div class="centered"><button><a href="#">Dals</a></button></div>
    </div>
   </div>

  <div class="column">
    <div class="container">
       <img src="images/1.webp" alt="Rice" style="width:300px; height: 300px;">
        <div class="centered"><button><a href="#">Rice</a></button></div>
    </div>
   </div> 

   <div class="column">
    <div class="container">
       <img src="images/6.webp" alt="Wheat flour" style="width:300px; height: 300px;">
        <div class="centered"><button><a href="#">Wheat</a></button></div>
    </div>
   </div> 

   
   </div>             
   
   

   
<div class="row" style="margin-left: 1%;">
  <div class="column">
    <div class="container">
       <img src="images/16.webp" alt="Ghee" style="width:300px; height: 300px;">
        <div class="centered"><button><a href="#">Ghee</a></button></div>
    </div>
   </div> 

   <div class="column">
    <div class="container">
       <img src="images/28.jpg" alt="Oils" style="width:300px; height: 300px;">
        <div class="centered"><button><a href="#">Cooking Oils</a></button></div>
    </div>
   </div> 

   <div class="column">
    <div class="container">
       <img src="images/35.webp" alt="salt" style="width:300px; height: 300px;">
        <div class="centered"><button><a href="#">Salt</a></button></div>
    </div>
   </div> 
   </div> 




<div class="row" style="margin-left: 1%">
  <div class="column">
    <div class="container">
       <img src="images/40.webp" alt="Sugar" style="width:300px; height: 300px;">
        <div class="centered"><button><a href="#">Sugar</a></button></div>
    </div>
   </div> 

   <div class="column">
    <div class="container">
       <img src="images/41.webp" alt="Tea" style="width:300px; height: 300px;">
        <div class="centered"><button><a href="#">Tea</a></button></div>
    </div>
   </div> 

   <div class="column">
    <div class="container">
       <img src="images/46.webp" alt="Masalas" style="width:300px; height: 300px;">
        <div class="centered"><button><a href="#">Masalas</a></button></div>
        <br>
        <br>
    </div>
   </div> 
   </div> 

    </section>


    <div class="foo">
    <br>
    Copyright © 2022. All rights reserved by SRI-002 DA-IICT.
</div>
   
  </body>
</html>

      