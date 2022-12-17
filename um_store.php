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
    <title>Stores</title>
    <link rel="stylesheet" href="updatemanager.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" charset="utf-8"></script>



    <style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 60%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: center;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  /* background-color: #04AA6D; */
  background-color: #eab029;
  color: white;
}

:root{
  --green:#27ae60;
  /* --black:#333; */
  --white:#fff;
  /* --bg-color:#eee;
  --box-shadow:0 .5rem 1rem rgba(0,0,0,.1);
  --border:.1rem solid var(--black); */
  /* --primary-color1: rgb(11, 78, 179); */
  --primary-color: #27ae60;
}


.btn{
    /* display: block; */
    width: 50%;
    cursor: pointer;
    border-radius: .5rem;
    margin-top: 0.7rem;
    font-size: 1rem;
    padding:0.2rem 0.7rem;
    /* background: var(--green); */
    background:rgb(15, 172, 159);
    
    color:var(--white);
    text-align: center;
 }

  .btn:hover {
    box-shadow: 0 0 0 2px #fff, 0 0 0 3px var(--primary-color);
  }
</style>

    <title> All Stores</title>
  </head>
  <body>

    <header>
      <a href="#" class="logo">PricePared</a>
      <div class="navigation">
        <ul class="menu">
          <div class="close-btn"></div>
          <li class="menu-item"><a href="updatemanager.php">Home</a></li>

          <li class="menu-item"><a href="um_store.php">Stores</a></li>
          
          <li class="menu-item"><a href="um_edit_price.php">Edit Price</a></li>

          <li class="menu-item"><a href="um_profile.php">Profile</a></li>
          <li class="menu-item"><a href="login-user.php">Logout</a></li>
        </ul>
      </div>
      <div class="menu-btn"></div>
    </header>


   
    
    <section class="section-home">
    
    <h1>
    <pre>
       
       S  
       T  
       O  
       R
       E 
       S           
    </pre>
    </h1>
          

<table id="customers">
  <tr>
    <th>City</th>
    <th>Location</th>
    <th>Store</th>
    <th>View Products</th>
  </tr>
  
  <?php

        $records = mysqli_query($con,"select * from storetable"); // fetch data from database

        while($data = mysqli_fetch_array($records))
        {
        ?>
        <tr>
            <td><?php echo $data['city']; ?></td>
            <td><?php echo $data['location']; ?></td>
            
            <td><?php echo $data['store_name']; ?></td>
            <td>
                <a href="um_see_products.php?see=<?php echo $data['id']; ?>" class="btn"> select </a>
            </td>
        </tr>	
        <?php
        }
        ?>


</table>

  </body>
</html>



