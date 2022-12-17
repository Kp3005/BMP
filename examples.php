<?php
require_once "connection.php";
require "Chart.php";
use Antoineaugusti\EasyPHPCharts\Chart;
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Charts</title>
	<link rel="stylesheet" href="chart.css">
	<style>
		*{margin: 0; padding: 0;}
		@import url(http://fonts.googleapis.com/css?family=Roboto);
		body{background: #FFF; font-family: 'Roboto', sans-serif;font-weight: 400}
		#content{background: #FFF; width: 1000px; padding: 20px; margin: 0 auto}
		h2{color: #4081BD; margin-bottom: 20px; font-weight: 400}
		.clearBoth:after{width: 300px; border: 1px solid #EEE; margin: 50px 0; display: block;}
		.containerChartLegend{width: 480px;padding-left: 20px}
	</style>
	<script src="ChartJS.min.js"></script>
</head>
<body>
	<div id="content">
		<?php
		/*
		//	A basic example of a pie chart
		*/
		//storevise sales
		$cart_query = mysqli_query($con, "SELECT sum(total),store,location FROM `order_pick` group by store,location");
         $price_total = 0;
         if(mysqli_num_rows($cart_query) > 0){
            while($product_item = mysqli_fetch_assoc($cart_query)){
               $product_price[] = $product_item['sum(total)'];
               $product_name[] = $product_item['store'].' ,'. $product_item['location'] ;
            };
         };
		$pieChart = new Chart('pie', 'examplePie');
		$pieChart->set('data', $product_price);
		$pieChart->set('legend', $product_name);
		$pieChart->set('displayLegend', true);
		echo $pieChart->returnFullHTML();

		/*
		//	An example of a doughnut chart with legend in percentages
		*/
		

		/*
		//	An example of a bar chart with multiple datasets
		*/
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

<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">

<!-- <input type="text" placeholder="enter product name" name="product_name" class="box"> -->
<select name='product_name'>
	<option selected disabled>--- Select ---</option>
	<?php
	$selectcat=mysqli_query($con,"select * from history");
	while($datacat = mysqli_fetch_array($selectcat))
	{
	?>
		<option value="<?php echo $datacat['product_name']; ?>">  
							<?php echo $datacat['product_name'];?>  
		</option>
		<?php
	}
	?>
</select>
<input type="submit" class="btn" name="add_product" value="Search">
</form>

<?php
if(isset($_POST['add_product'])){
	$p_name = $_POST['product_name'];
	
	
		$cart_query2 = mysqli_query($con, "SELECT * FROM `history` where product_name='$p_name'");
         if(mysqli_num_rows($cart_query2) > 0){
            while($product_item2 = mysqli_fetch_assoc($cart_query2)){
               $price[] = $product_item2['price'];
               $date[] = date("Y-m-d", strtotime($product_item2['date'])) ;
            };
         };
		//  date($product_item2['date'])
		$barChart1 = new Chart('bar', 'examplebar1');
		$barChart1->set('data', $price);
		$barChart1->set('legend', $date);
		// We don't to use the x-axis for the legend so we specify the name of each dataset
		$barChart1->set('legendData', array($p_name));
		$barChart1->set('displayLegend', true);
		echo $barChart1->returnFullHTML();
		
	
}?>

	</div>
</body>
</html>