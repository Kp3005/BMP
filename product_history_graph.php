<html>
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
    <title> Bar graph</title>

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
<body style="background-color:whitesmoke">

<div class="navbar">
        <a class="active" href="admin.php" style="float: left; font-weight: 600; text-shadow: 15px; color:white ;">PricePared.com  </a>
        
        <a href="admin.php">Back</a>
    </div>
    <!-- <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br> -->

<!-- <h2>Product Vs Total sales bar graph of a store</h2> -->
<div class="season_tab" style="margin-top: 10%">
<h2>Product Vs Total sales bar graph of a store</h2>
<br>
<br>
            <input type="radio" id="tab-9" name="tab-group-1">
            <label class="extra" for="tab-9">Select the product name from the drop-down to know about the monthly sales of the product.</label>
            <div class="season_content" style="margin-left:4%; height:75%; width:1080px; border:1px solid #ccc;overflow:auto; margin-top: 7%">
                <span>
<!-- product price History -->

<form action="" method="post">

<select name='pname' style="border: 1px solid black; margin-top:5%">
	<!-- <option selected disabled>--- Select Product Name ---</option> -->

	<?php 

	$selectcatx=mysqli_query($con,"select * from history");
	while($datacatx = mysqli_fetch_array($selectcatx))
	{
	?>
		<option value="<?php echo $datacatx['product_name']; ?>">  
							<?php echo $datacatx['product_name'];?>  
		</option>
		<?php
	}
	?>
</select>

<select name='cityname' style="border: 1px solid black; margin-top:5%">
	<!-- <option selected disabled>--- Select City Name ---</option> -->

	<?php 

	$selectcatxy=mysqli_query($con,"select * from history GROUP BY mall_id");
	while($datacatxy = mysqli_fetch_array($selectcatxy))
	{
    $mallid=$datacatxy['mall_id'];
     $city_selectx= mysqli_query($con,"select * from storetable WHERE id='$mallid'");
     $city_select=mysqli_fetch_assoc($city_selectx);
	?>
		<option value="<?php echo $city_select['id']; ?>">  <?php echo $city_select['store_name']. ' , '.$city_select['location']. ' , '.$city_select['city'];?>  </option>
		<?php
	}
	?>
</select>

<input type="submit" class="btng" name="search_list" value="Search" style="width:10%; margin-left:75%; margin-bottom:10%" >
</form>

<?php
if(isset($_POST['search_list'])){
	$p_name = $_POST['pname'];
  $cityid=$_POST['cityname'];
  
  // $option = if();
  if($p_name && $cityid)
  {
    $cart_query2 = mysqli_query($con, "SELECT * FROM `history` where product_name='$p_name' AND mall_id='$cityid'");
         if(mysqli_num_rows($cart_query2) > 0){
            while($product_item2 = mysqli_fetch_assoc($cart_query2)){
               $price[] = $product_item2['price'];
               $date[] = date("Y-m-d", strtotime($product_item2['date'])) ;
            };
            //  date($product_item2['date'])
		$barChart1 = new Chart('bar', 'examplebar1');
		$barChart1->set('data', $price);
		$barChart1->set('legend', $date);
		// We don't to use the x-axis for the legend so we specify the name of each dataset
		$barChart1->set('legendData', array($p_name));
		$barChart1->set('displayLegend', true);
		echo $barChart1->returnFullHTML();
         }
         else{
    echo '<div style="background-color:#f69e10; padding:10px; font-size:36px; weight:500;"><center>Product Price is not Updated Yet.</center></div>';
    echo '<br>';
         }
}
  else{
    echo '<br>';
    echo '<br>';
    echo '<br>';
    //  echo "Please enter Email";
     echo '<div style="background-color:#f69e10; padding:5px; font-size:22px; weight:200;"><center>Please select both</center></div>';
echo '<br>';
  }
}
      ?>
</div>
                    </div>

                </span>


     
</body>
</html>
