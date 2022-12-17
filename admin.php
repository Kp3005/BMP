
<?php require_once "controllerUserData.php"; ?>

<?php
require_once "connection.php";
require "Chart.php";
use Antoineaugusti\EasyPHPCharts\Chart;
?>


<?php

$qry = "SELECT * FROM `usertable` WHERE code='0'";
$res = mysqli_query($con, $qry);
$ans= mysqli_num_rows($res);


$qry1 = "SELECT * FROM `storetable`";
$res1 = mysqli_query($con, $qry1);
$ans1= mysqli_num_rows($res1);


$qry2 = "SELECT * FROM `category`";
$res2 = mysqli_query($con, $qry2);
$ans2= mysqli_num_rows($res2);

$qry3="SELECT sum(total) as total FROM `order_pick`";
$res3=mysqli_query($con, $qry3);
$xyz = mysqli_fetch_assoc($res3);
$ans3=$xyz['total'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="admin.css">
    <link rel="stylesheet" href="items.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="admin.js" defer></script>
    <!-- <script src="https://kit.fontawesome.com/a81368914c.js"></script> -->
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
    <!-- <title>Admin Panel</title> -->

    <script src="ChartJS.min.js"></script>
    <link rel="stylesheet" href="chart.css">
    <title> Admin Panel</title>

<style>

.cards{
  /* width: 80%;
  padding: 35px 20px;
  display: grid;
  grid-template-columns: repeat(4,1fr);
  grid-gap: 350px; */

    width: 800px;
    padding: 10px 10px;
    display: grid;
    grid-template-columns: repeat(4,1fr);
    grid-gap: 60px;

}

.cards .card{
  padding: 30px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 7px 25px 0 rgba(0,0,0,0.08);
}

.number{
  font-size: 35px;
  font-weight: 500;
  color: rgb(15, 172, 159);

}

.card-name{
  color: rgb(39, 30, 30);
  font-weight: 600;
  font-size: 20px;
}


.icon-box i{
  font-size: 35px;
  color: rgb(15, 172, 159);
  margin-left:10px;
  margin-top:35px;
}
.btng{
    display: block;
    width: 10%;
    cursor: pointer;
    border-radius: .5rem;
    margin-top: 1rem;
    font-size: 1.1rem;
    padding:0.6rem 1rem;
    background: var(--green);
    color:var(--white);
    text-align: center;
 }

 
  .btng:hover {
    box-shadow: 0 0 0 2px #fff, 0 0 0 3px var(--primary-color);
  }



</style>
</head>
<body>
    <div class="navbar">
        <a class="active" href="MAIN_FRONT.html" style="float: left; font-weight: 600; text-shadow: 15px; color:white ;">PricePared.com  </a>
        <!-- <button type="button" class="btnn"><a href="logout-user.php">Logout</a></button> -->
        <a href="logout-user.php">Logout</a>
    </div>
    <div class="season_tabs">
        <div class="season_tab">
            <input type="radio" id="tab-1" name="tab-group-1" checked>
            <label class="extra" for="tab-1">Dashboard</label>
            <div class="season_content">
                <span>
                    <div class="content">
                        <div class="welcomebox">
                            <img src="admin.png" alt="" height="250px" width="auto">
                            <h1>Welcome to Admin's panel</h1>
                            <h3>What would you want to do today?</h3>
                        </div>
                    </div>
                    

                </span>
            </div> 
        </div>
        <div class="season_tab">
            <input type="radio" id="tab-0" name="tab-group-1">
            <label class="extra" for="tab-0">List Items</label>
            
            <div class="season_content">
            <div class="season_content" style="margin-left:-15%; height:75%; width:1035px; border:1px solid #ccc;font-style: Georgia, Garamond, Serif; overflow:auto; font-size:10px; line-height: 1.3;">
            
                <span> 
                <?php
                $select = mysqli_query($con, "SELECT * FROM category order by p_category");
                ?>
                <div class="product-display">
                  <center>
                    <table class="product-display-table">
                      <thead >
                      <tr>
                          <th>Product image</th>
                          <th>Product name</th>
                          <th>Product category</th>
                          <th>action</th>
                      </tr>
                      </thead>
                      <?php while($row = mysqli_fetch_assoc($select)){ ?>
                      <tr>
                          <td><img src="images/<?php echo $row['p_img']; ?>" height="100" alt=""></td>
                          <td><?php echo $row['p_name']; ?></td>
                          <td><?php echo $row['p_category']; ?></td>
                          <td>
                            <a href="update_items.php?edit=<?php echo $row['PID']; ?>" class="btn">  edit </a>
                            <a href="admin.php?delete=<?php echo $row['PID']; ?>" class="btn">  delete </a>
                          </td>
                      </tr>
                    <?php } ?>
                    </table>
                      </center>
                </div>
                </span>
            </div>
                      </div> 
        </div>

        <div class="season_tab">
            <input type="radio" id="tab-2" name="tab-group-1">
            <label class="extra" for="tab-2">List Customers</label>
            
            <div class="season_content" >
            <div class="season_content" style=" height:75%;width:1000px;border:1px solid #ccc;font:15px/24px Georgia, Garamond, Serif;overflow:auto; margin-left:-15%;">
            <!-- margin-left:-15%; height:75%; width:1035px; border:1px solid #ccc;font-style: Georgia, Garamond, Serif; overflow:auto; font-size:10px; line-height: 1.3;     -->
            <span>
                <div class="w3-container">
                <center>
            <!-- <div style="background-color: rgb(15, 172, 159); font-size: 50px; font-weight: 700">Customer Details</div> -->
            <h2>Customer Details</h2>
            
            <!-- <table border="1" style="background-color:white"> -->
              <table class="w3-table-all">
            <tr class="w3-orange">
                <td>Name</td>
                <td>Email</td>
                <!-- <td>password</td> -->
                <td>Contact</td>
                <td>Address</td>
                <!-- <td>Edit</td>
                <td>Delete</td> -->
            </tr>

            <?php

            // include "connection.php"; // Using database connection file here

            $records = mysqli_query($con,"select * from usertable WHERE status='verified'"); // fetch data from database

            while($data = mysqli_fetch_array($records))
            {
            ?>
            <tr>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo $data['email']; ?></td>
                 
                <td><?php echo $data['contact']; ?></td>
                <td><?php echo $data['address']; ?></td>  
                <!-- <td><a href="">Edit</a></td>
                <td><a href="">Delete</a></td> -->
            </tr>	
            <?php
            }
            ?>
            </table>
            </center>
          </div>
                  <span>
          </div>
            </div> 
        </div>
         
        



        <div class="season_tab">
            <input type="radio" id="tab-3" name="tab-group-1">
            <label class="extra" for="tab-3">List Stores</label>
            
            <div class="season_content">
            <div class="season_content" style="margin-left:-15%;height:75%;width:1000px;border:1px solid #ccc;font:15px/24px Georgia, Garamond, Serif;overflow:auto;">
                <span>
                <div class="w3-container">
                <center>
            <!-- <div style="background-color: rgb(15, 172, 159); font-size: 50px; font-weight: 700">Customer Details</div> -->
            <h2>Store Details</h2>
            
            <!-- <table border="1" style="background-color:white"> -->
              <table class="w3-table-all">
            <tr class="w3-orange">
                <td>City</td>
                <td>Location</td>
                <td>Store</td>
            </tr>

            <?php

            // include "connection.php"; // Using database connection file here

            $records = mysqli_query($con,"select * from storetable order by city"); // fetch data from database

            while($data = mysqli_fetch_array($records))
            {
            ?>
            <tr>
                <td><?php echo $data['city']; ?></td>
                <td><?php echo $data['location']; ?></td>
                 
                <td><?php echo $data['store_name']; ?></td>
                <!-- <td><a href="">Edit</a></td>
                <td><a href="">Delete</a></td> -->
            </tr>	
            <?php
            }
            ?>
            </table>
            </center>
          </div>
                  <span>
            </div> 
          </div>
        </div>
         
        
        <div class="season_tab">
            <input type="radio" id="tab-4" name="tab-group-1">
            <label class="extra" for="tab-4">Add Items</label>
          
            <div class="season_content">
                <span>

              
                <div class="admin-product-form-container">

              <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <h3>Add a new product</h3>
                <input type="text" placeholder="enter product name" name="product_name" class="box">
                <!-- <input type="text" placeholder="enter product category" name="product_category" class="box"> -->
                Product Category:
                <select name='product_category'>
                  <!-- <option selected disabled>--- Select ---</option> -->
                  <?php
                    $selectcat=mysqli_query($con,"select * from onlycategory");
                    // $select="onlycategory";  
                    // if (isset ($select)&&$select!=""){  
                    // $select=$_POST ['NEW']; 
                    // }
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
                <input type="file" accept="image/png, image/jpeg, image/webp, image/jpg" name="product_image" class="box">
                <input type="submit" class="btn" name="add_product" value="add product">
              </form>

              </div>

                </span>
                <!-- <a href="add_items.php"> Add item</a> -->
            </div> 
        </div>




        <div class="season_tab">
            <input type="radio" id="tab-5" name="tab-group-1">
            <label class="extra" for="tab-5">Add Category</label>
          
            <div class="season_content">
                <span>
<pre>



</pre>
              
                <div class="admin-product-form-container">

              <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <h3>Add a new Category</h3>
                <!-- <input type="text" placeholder="enter product name" name="product_name" class="box"> -->
                <input type="text" placeholder="enter new category" name="product_category" class="box">
                <!-- <input type="file" accept="image/png, image/jpeg, image/webp, image/jpg" name="product_image" class="box"> -->
                <input type="submit" class="btn" name="add_category" value="add category">
              </form>

              </div>

                </span>
                <!-- <a href="add_items.php"> Add item</a> -->
            </div> 
        </div>




        

        <div class="season_tab">
            <input type="radio" id="tab-6" name="tab-group-1">
            <label class="extra" for="tab-6">Add Store
            </label>
          
            <div class="season_content">
                <span>
  <div class="add_store_form">
    <!-- <a href="index_form.html">ADD STORE</a> -->
    <form action="admin.php" method="post" class="form">      
					<!-- <img src="avatar.jpg"> -->
					<!-- <img src="avatar.svg"> -->
				   <h3>Register Store</h3>

    <!-- <form action="admin.php" method="post" class="form">
      <h1 class="text-center">Register Store</h1> -->
      <!-- <center> <p><button type="reset">.</button></p></center> -->
      <!-- Progress bar -->
      <div class="progressbar">
        <div class="progress" id="progress"></div>
        
        <div class="progress-step progress-step-active" data-title="Store Details"></div>
        <div class="progress-step" data-title="Update Manager Details"></div>
      </div>

      <!-- Steps -->
      <div class="form-step form-step-active">
        <div class="input-group">
          <label class="heading" for="city">Enter City</label>
          <input type="text" name="city" id="city" placeholder="Enter City" />
        </div>
        <div class="input-group">
            <label class="heading" for="location">Enter Location</label>
            <input type="text" name="location" id="location" placeholder="Enter Location" />
        </div>
        <div class="input-group">
          <label class="heading" for="store">Enter Store</label>
          <input type="text" name="store" id="store" placeholder="Enter Store"/>
        </div>

        <div class="btns-group">
            <!-- <input type="submit" name="Insert" value="Submit" class="btn" /> -->
          <!-- <input type="submit" name="Insert" value="Insert" class="btn" /> -->
            <a href="#" class="btn btn-next">Next</a>
         
          
        </div>
        <!-- <input type="submit" name="signup" value="Register" class="form-btn"> -->
      </div>

      <div class="form-step">

        <div class="input-group">
          <label class="heading" for="name">Update Manager Name</label>
          <input type="text" name="u_name" id="name" placeholder="Update Manager Name" />
        </div>

        <div class="input-group">
          <label class="heading" for="age">Age</label>
          <input type="text" name="u_age"  id="age" placeholder="Update Manager Age"/>
        </div>

        <div class="input-group">
            <label class="heading" for="contact">Contact Number</label>
            <input type="text" name="u_contact" id="password" placeholder="Contact Number"/>
          </div>

          <div class="input-group">
            <label class="heading" for="email">Email</label>
            <input type="text" name="u_email" id="email" placeholder="Email Address"/>
          </div>

          
          <!-- <div class="input-group">
            <label class="heading" for="Username">User Name</label>
            <input type="text" name="password" id="password" placeholder="User Name"/>
          </div> -->
  
          <div class="input-group">
            <label class="heading" for="password">Password</label>
            <input type="password" name="u_password" id="password" placeholder="Password"/>
          </div>

        <div class="btns-group">
          <a href="#" class="btn btn-prev">Previous</a>
          <input type="submit" name="Insert" value="Submit" class="btn" />
          <!-- <center><p><button type="reset">Reset</button></p></center> -->
        </div>
      </div>
    </form>
  </div>
                </span>
            </div> 
        </div>



        <div class="season_tab">
            <input type="radio" id="tab-7" name="tab-group-1">
            <label class="extra" for="tab-7">Edit Update Manager</label>
          
            <div class="season_content">
            <div class="season_content" style="margin-left:-15%; height:75%; width:1030px; border:1px solid #ccc;font:15px/24px Georgia, Garamond, Serif;overflow:auto;">
                <span>
                <div class="w3-container">
                <center>
            <!-- <div style="background-color: rgb(15, 172, 159); font-size: 50px; font-weight: 700">Customer Details</div> -->
            <h2>Updates Managers Details</h2>
            
            <!-- <table border="1" style="background-color:white"> -->
              <table class="w3-table-all">
            <tr class="w3-orange">
                <td>ID</td>
                <td>Name</td>
                <!-- <td>password</td> -->
                <td>Age</td>
                <td>Contact</td>
                <td>Email</td>
                <td>Password</td>
                <td>City</td>
                <td>Location</td>
                <td>Store</td>
            </tr>

            <?php

            // include "connection.php"; // Using database connection file here

            $records = mysqli_query($con,"select * from umtable NATURAL JOIN storetable where umtable.umid=storetable.id order BY city"); // fetch data from database

            while($data = mysqli_fetch_array($records))
            {
            ?>
            <tr>
                <td><?php echo $data['umid']; ?></td>
                <td><?php echo $data['u_name']; ?></td>
                <td><?php echo $data['u_age']; ?></td>
                <td><?php echo $data['u_contact']; ?></td>
                <td><?php echo $data['u_email']; ?></td> 
                <td><?php echo $data['u_password']; ?></td>
                <td><?php echo $data['city']; ?></td>
                <td><?php echo $data['location']; ?></td>   
                <td><?php echo $data['store_name']; ?></td>     
                <!-- <td><a href="">Edit</a></td> -->
                <td><a href="update_UM.php?edit=<?php echo $data['umid']; ?>">  edit </a></td>
                <!-- <td><a href="">Delete</a></td> -->
            </tr>	
            <?php
            }
            ?>
            </table>
            </center>
          </div>
                  <span>
          </div>
            </div> 
        </div>




        <div class="season_tab">
            <input type="radio" id="tab-8" name="tab-group-1">
            <label class="extra" for="tab-8">Customer Messages</label>
          
            <div class="season_content">
            <div class="season_content" style="margin-left:-15%; height:75%; width:1030px; border:1px solid #ccc;font:15px/24px Georgia, Garamond, Serif;overflow:auto;">
                <span>
                <div class="w3-container">
                <center>
                <br>
<br>

            <h2>Customers Messages</h2>
            
              <table class="w3-table-all">
            <tr class="w3-orange">
                <td>Name</td>
                <td>Email</td>
                <td>Message/Complains</td>
            </tr>

            <?php

            // include "connection.php"; // Using database connection file here

            $records = mysqli_query($con,"select * from contact"); // fetch data from database

            while($data = mysqli_fetch_array($records))
            {
            ?>
            <tr>
                <td><?php echo $data['name']; ?></td>
                <td><?php echo $data['email']; ?></td>
                 
                <td><?php echo $data['msg']; ?></td>
                <!-- <td><a href="">Edit</a></td>
                <td><a href="">Delete</a></td> -->
            </tr>	
            <?php
            }
            ?>
            </table>
            </center>
          </div>

                </span>
            </div> 
          </div>
        </div>




        <div class="season_tab">
            <input type="radio" id="tab-10" name="tab-group-1">
            <label class="extra" for="tab-10">Add Delivery Boy</label>
          
            <div class="season_content">
                <span>

              
                <div class="admin-product-form-container">
                <form action="admin.php" method="post" class="form">
                <h3>Register Delivery Boy</h3>
                <input type="text" placeholder="enter name" name="del_name" class="box">
                <input type="text" placeholder="enter email" name="del_email" class="box">
                <input type="text" placeholder="enter password" name="pwd" class="box">
                <!-- <input type="text" placeholder="enter product category" name="product_category" class="box"> -->

                <!-- <input type="file" accept="image/png, image/jpeg, image/webp, image/jpg" name="product_image" class="box">-->
                <input type="submit" class="btn" name="add_delivery_boy" value="Register">
              </form>

              </div>

                </span>
                <!-- <a href="add_items.php"> Add item</a> -->
            </div> 
        </div>

        <div class="season_tab">
            <input type="radio" id="tab-9" name="tab-group-1">
            <label class="extra" for="tab-9">Analytics</label>
            <div class="season_content" style="margin-left:4%; height:75%; width:1080px; border:1px solid #ccc;overflow:auto;">
                <span>
                <div class="main">
                      <div class="cards">
                        <div class="card">
                          <div class="card-content">
                            <div class="number"><?php echo "$ans" ?></div>
                            <div class="card-name">Customers</div>
                          </div>
                          <div class="icon-box">
                            <i class="fas fa-user"></i>
                          </div>
                        </div>

                        <div class="card">
                          <div class="card-content">
                            <div class="number"><?php echo "$ans1" ?></div>
                            <div class="card-name">Partners</div>
                          </div>
                          <div class="icon-box">
                            <i class="fas fa-store"></i>
                          </div>
                        </div>

                        <div class="card">
                          <div class="card-content">
                            <div class="number"><?php echo "$ans2" ?></div>
                            <div class="card-name">Products</div>
                          </div>
                          <div class="icon-box">
                            <i class="fas fa-shopping-basket"></i>
                          </div>
                        </div>

                        <div class="card">
                          <div class="card-content">
                            <div class="number"><?php echo "$ans3" ?></div>
                            <div class="card-name">Total Sales</div>
                          </div>
                          <div class="icon-box">
                            <i class="fas fa-shopping-cart"></i>
                          </div>
                        </div>

                        
                      </div>
                      <!-- <div class="charts"></div> -->
                      <div id="content">
                        <br>
                        <br>
                        
		<?php
		
    
    ?>
<hr style="background-color:grey; border:1px solid"></hr>
<h2>Store Vs Total sales Pie chart</h2>
<?php
		//store vise sales
		$cart_queryx = mysqli_query($con, "SELECT sum(total),store,location FROM `order_pick` group by store,location");
        
         if(mysqli_num_rows($cart_queryx) > 0){
            while($product_itemx = mysqli_fetch_assoc($cart_queryx)){
               $product_pricex[] = $product_itemx['sum(total)'];
               $product_namex[] = $product_itemx['store'].' ,'. $product_itemx['location'] ;
            };
         };
		$pieChart = new Chart('pie', 'examplePie');
		$pieChart->set('data', $product_pricex);
		$pieChart->set('legend', $product_namex);
		$pieChart->set('displayLegend', true);
		echo $pieChart->returnFullHTML();

    

//feedback vise stores 
?>
<br>
<br>
<hr style="background-color:grey; border:1px solid"></hr>
<h2>Store Vs Feedback bar graph</h2>

<?php
		$cart_query1 = mysqli_query($con, "SELECT avg(feedback),store,location FROM `order_pick` group by store,location");
         if(mysqli_num_rows($cart_query1) > 0){
            while($product_item1 = mysqli_fetch_assoc($cart_query1)){
               $product_feed[] = $product_item1['avg(feedback)'];
               $product_store[] = $product_item1['store'].' ,'. $product_item1['location'] ;
            };
         };
		$barChart = new Chart('bar', 'examplebar');
		$barChart->set('data', $product_feed);
		$barChart->set('legend', $product_store);
		// We don't to use the x-axis for the legend so we specify the name of each dataset
		$barChart->set('legendData', array('Feedback'));
		$barChart->set('displayLegend', true);
		echo $barChart->returnFullHTML();
?>



<hr style="background-color:grey; border:1px solid"></hr>
<!-- product price History -->
<h2>To know about monthly sales of a product of a particular store, click on the button below.</h2>
<button style="font-size: 20px; padding:10px"><a href="product_history_graph.php" target="_blank">Click here</a></button>
	</div>
                    </div>

                </span>
            </div> 
        </div>
</div>
     </div>
     
</body>
</html>