<?php require_once "connection.php"?>
<?php
if(isset($_POST['add_in'])){

$product_name = $_POST['product_name'];
$product_category = $_POST['product_category'];


if(empty($product_name) || empty($product_category)){
   $message[] = 'please fill out all';
}else{
//    $insert = "INSERT INTO `product`(`category`, `products`, `d_date`) VALUES ('$product_category','$product_name',CURRENT_TIMESTAMP)";
   $insert = "UPDATE product SET category='$product_category' WHERE products='$product_name'";
   $upload = mysqli_query($con,$insert);
   if($upload){
      $message[] = 'new product added successfully';
   }else{
      $message[] = 'could not add the product';
   }
}

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="season_tab">
            <input type="radio" id="tab-4" name="tab-group-1">
            <label class="extra" for="tab-4">Add Items</label>
          
            <div class="season_content">
                <span>

              
                <div class="admin-product-form-container">

              <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <h3>Add a new product</h3>
                <input type="text" placeholder="enter product name" name="product_name" class="box">
                <input type="text" placeholder="enter product category" name="product_category" class="box">
                
                <input type="submit" class="btn" name="add_in" value="add product">
              </form>

              </div>

                </span>
                <!-- <a href="add_items.php"> Add item</a> -->
            </div> 
        </div>
</body>
</html>

