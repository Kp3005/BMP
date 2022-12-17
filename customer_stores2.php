<?php

require_once "controllerUserData.php";
// @include 'connection.php';
// $city = $_GET['edit'];  
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



<?php
if(isset($_POST['add_to_cart'])){

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $mall_id = $_POST['mall_id'];
   $cid=$fetch_info['No'];
   $product_quantity = 1;


   $qry=mysqli_query($con, "SELECT * FROM `storetable` WHERE id = '$mall_id'");
   $data5=mysqli_fetch_array($qry);
   $store=$data5['store_name'];
   $location=$data5['location'];


   $select_cart = mysqli_query($con, "SELECT * FROM `cart` WHERE name = '$product_name' AND c_id='$cid'");

   if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
   }else{
      $insert_product = mysqli_query($con, "INSERT INTO `cart`(c_id,name, price, image, quantity, store, location,l_date) VALUES('$cid','$product_name', '$product_price', '$product_image', '$product_quantity','$store','$location',current_timestamp)");
      $message[] = 'product added to cart succesfully';
   }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="customer_stores.css">
    <!-- <link rel="stylesheet" href="css/style.css"> -->
    <title>PricePAred.com Shopping</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="css/cart_style.css"> -->
<style>

.cart{
    width: 130px;
    height:30px;
    margin-top:10px;
    margin-bottom:30px;
    margin-left:-10px;

}
.cart:hover{
    background-color:#EEBF00;
}
.card img{
    height: 200px;
    width:200px;
    margin-left:20%;
    margin-bottom: 30px;
    margin-top: 30px;
    border: solid 2px grey;
}
b{
    font-size: 30px;
    font-family: georgia;
    color: white;
    background-color: #EEBF00;
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


</head>
<body>
    




    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-3">
                    <div class="card-header">
                        <!-- <h4>How to Filter or Find or Search data using Multiple Checkbox in php</h4> -->
                        <header>
      <a href="#" class="logo">PricePared</a>
      <div class="navigation">
        <ul class="menu">
          <div class="close-btn"></div>
          <li class="menu-item"><a href="customerpage.php">Home</a></li>
          <li class="menu-item"> <a href="order.php">My Orders</a></li>
          <li class="menu-item"><a href="c_profile.php">Profile</a></li>
          <li class="menu-item"><a href="login-user.php">Logout</a></li>
          <?php

      $cid=$fetch_info['No'];
      $select_rows = mysqli_query($con, "SELECT * FROM `cart` WHERE c_id='$cid'");
      $row_count = mysqli_num_rows($select_rows);

      ?>

      <li class="menu-item"><a href="cart.php" >cart: <span><?php echo $row_count; ?></span> </a></li>
      <div id="menu-btn" class="fas fa-bars"></div>
        </ul>
      </div>
      <div class="menu-btn"></div>
    </header>

                    </div>
                </div>
            </div>
<br>
<br>
<br>
<br>
<br>
<br>
            <!-- Brand List  -->
            <div class="col-md-3">
                <form action="" method="GET">
                    <div class="card shadow mt-3">
                        <div class="card-header">
                            <h5>Filter 
                                <button type="submit" class="btn btn-primary btn-sm float-end">Search</button>
                            </h5>
                        </div>
                        <div class="card-body">
                            <h6>Store List</h6>
                            <hr>
                            <?php
                                $con = mysqli_connect("localhost","root","","pricepared");
// ------------------------------------------------------------------------------------------------------------------------------------------
                             




                            $store_query = "SELECT * FROM storetable where city='Mumbai'";
                                $store_query_run  = mysqli_query($con, $store_query);

                                if(mysqli_num_rows($store_query_run) > 0)
                                {
                                    foreach($store_query_run as $storelist)
                                    {
                                        $checked = [];
                                        if(isset($_GET['brands']))
                                        {
                                            $checked = $_GET['brands'];
                                        }
                                        ?>
                                            <div>
                                                <input type="checkbox" name="brands[]" value="<?= $storelist['id']; ?>" 
                                                    <?php if(in_array($storelist['id'], $checked)){ echo "checked"; } ?>
                                                 />
                                                <?= $storelist['store_name'],", ",$storelist['location']; ?>
                                            </div>
                                        <?php
                                    }
                                }
                                // else
                                // {
                                //     echo "No Brands Found";
                                // }
//---------------------------------------------------------------------------------------------------------------------------------------------- 
                            ?>
                        </div>






                        <div class="card-body">
                            <h6>Category List</h6>
                            <hr>
                            <?php
                                $con = mysqli_connect("localhost","root","","pricepared");
// ------------------------------------------------------------------------------------------------------------------------------------------
                                $category_query = "SELECT * FROM category group by p_category";
                                $category_query_run  = mysqli_query($con, $category_query);

                                if(mysqli_num_rows($category_query_run) > 0)
                                {
                                    foreach($category_query_run as $categorylist)
                                    {
                                        $checked = [];
                                        if(isset($_GET['ctgr']))
                                        {
                                            $checked = $_GET['ctgr'];
                                        }
                                        ?>
                                            <div>
                                                <input type="checkbox" name="ctgr[]" value="<?= $categorylist['p_category']; ?>" 
                                                    <?php if(in_array($categorylist['p_category'], $checked)){ echo "checked"; } ?>
                                                 />
                                                <?= $categorylist['p_category']; ?>
                                            </div>
                                        <?php
                                    }
                                }
                                // else
                                // {
                                //     echo "No Brands Found";
                                // }
//---------------------------------------------------------------------------------------------------------------------------------------------- 
                            ?>
                        </div>



                    </div>
                </form>
            </div>

            <!-- Brand Items - Products -->
            
            <div class="col-md-9 mt-3">
                <div class="card" style="padding:15px">
                
                    <div class="card-body row" style="padding:20px">
                    
                        <?php
                            if(isset($_GET['ctgr']))
                            {
                                $ctgrchecked = [];
                                $ctgrchecked = $_GET['ctgr'];
                                 
                                foreach($ctgrchecked as $getcategory)
                                {
                                    $varcat="SELECT * FROM category WHERE p_category='$getcategory'";
                                    $varcat_run = mysqli_query($con, $varcat);

                                    echo "<b>$getcategory</b>";
                                    echo '<hr>';
                                    echo '<br>';
                                    
                                    while($data1 = mysqli_fetch_array($varcat_run))
                                    {   
                                        echo $data1['p_name'];
                                        echo "<img src='images/" . $data1['p_img'] . "' alt='error'>";
                                        
                                        $nval= $data1['p_name'];

                                        foreach($_GET['brands'] as $value){
                                            $records = mysqli_query($con,"select * from current where mall_id='$value' AND product_name='$nval'");
                                           
                                            $qry="SELECT * FROM storetable WHERE id='$value'";
                                            $cnt=mysqli_query($con,$qry);
                                            $cnt1=mysqli_fetch_array($cnt);
                                            while($data = mysqli_fetch_array($records))
                                                {    
                                                    echo '<hr>';
                                                
                                                    if($data['price']=='0')
                                                    {
                                                        
                                                        echo $cnt1['store_name']." , ".$cnt1['location']."   ::    <br>      Not Available";
                                                        echo'<br>';
                                                        echo'<br>';
                                                    }
                                                    else {
                                                        
                                                        // echo $cnt1['store_name']." , ".$cnt1['location']."   ::          ".$data['price']." ₹  "."    "."<button class='cart'> Add to cart </button> "." "."<button class='qnt_btn'> - </button> "." Quantity "."<button class='qnt_btn'> + </button>";
                                                        echo $cnt1['store_name']." , ".$cnt1['location']."   ::     <br>     ".$data['price']." ₹  ";
                                                        echo'<br>';
                                                       
                                                    }
                                                    ?>
                                                    <form action="" method="post">
           <input type="hidden" name="product_name" value="<?php echo $data1['p_name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $data['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $data1['p_img']; ?>">
            <input type="hidden" name="mall_id" value="<?php echo $value; ?>">
            <?php
            if($data['price']!='0'){
            ?>
            <button type="submit" class="cart" name="add_to_cart">Add to cart</button>
            <!-- <button class='cart'> Add to cart </button> -->
            <?php
            }
            ?>
                                                    </form>
                                                    <?php
                                                }
                                        }
                                        echo '<br>';
                                        echo '<br>';
                                        echo '<br>';
                                        echo '<br>';
                                        echo '<hr style="border: solid 10px #232B38">';
                                        echo '<br>';
                                        echo '<br>';
                                        echo '<br>';
                                        echo '<br>';
                                       
                                    }
                                 
                                   // echo '<hr style="border: solid 5px black">';
                                    echo '<br>';
                                    echo '<br>';
                                  
                                }
 
                            }
                            else
                            {
                              echo "<p> <b> Welcome to PricePared.com </b> <br> Choose your favourite stores from the left side check box panel and get ready to compare prices of your favourite grocery items.</p><br>";
                            }
                        ?>
                        <!-- </form> -->
                    </div>
                    <img src=c1.jpg style="width:900px; height:400px; margin-left:15px; margin-top:5px; margin-bottom:100px"></img>
                    
                </div>
            </div>
            
        </div>
    </div>
    <div class="foo">
    <br>
    Copyright © 2022. All rights reserved by SRI-002 DA-IICT.
</div>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

