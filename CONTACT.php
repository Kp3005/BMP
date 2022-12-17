
<?php

@include 'connection.php';

if(isset($_POST['submit'])){

    $name = $_POST['name'];
    // $product_price = $_POST['product_price'];
     $email = $_POST['email'];
     $msg = $_POST['msg'];

  


      $qry = "INSERT INTO `contact`(`name`, `email`, `msg`) VALUES ('$name','$email','$msg')";
      $cnt_qry=mysqli_query($con, $qry);
   }


?>


<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="updatemanager.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>CONTACT US</title>
   </head>
<body>


<header>
      <a href="#" class="logo">PricePared</a>
      <div class="navigation">
        <ul class="menu">
          <div class="close-btn"></div>
          <li class="menu-item"><a href="MAIN_FRONT.html">Back</a></li>
          
        </ul>
      </div>
      <div class="menu-btn"></div>
    </header>

  <div class="container">
    <div class="content">
      <div class="left-side">
        <div class="address details">
          <i class="fas fa-map-marker-alt"></i>
          <div class="topic">Address</div>
          <div class="text-one">Relaince cross road, sector xyz</div>
          <div class="text-two">Ghandinager, Gujarat, India</div>
        </div>
        <div class="phone details">
          <i class="fas fa-phone-alt"></i>
          <div class="topic">Phone</div>
          <div class="text-one">+0098 9893 5xx7</div>
          <div class="text-two">+0096 3434 x678</div>
        </div>
        <div class="email details">
          <i class="fas fa-envelope"></i>
          <div class="topic">Email</div>
          <div class="text-one">201901xyz@gmail.com</div>
          <div class="text-two">info.xyz@gmail.com</div>
        </div>
      </div>
      <div class="right-side">
        <div class="topic-text">Send us a message</div>
        <p>If you have any queries related to the website working, you can contact us from here. It's our pleasure to assist you.</p>
      <form  action="" method ="post">
        <div class="input-box">
          <input type="text" name="name" placeholder="Enter your name">
        </div>
        <div class="input-box">
          <input type="text" name="email" placeholder="Enter your email">
        </div>
        <div class="input-box message-box">
            <textarea name ="msg" placeholder="Enter your message"></textarea>
          </div>
          <div class="button">
            <input type="submit" name="submit" value="Send Now" >
            <!-- <input type="submit" value="Send Now" name="submit" class="button"> -->
          </div>
        </form>
      </div>
      </div>
    </div>
  
  </body>
  </html>
  