<?php 
session_start();
require "connection.php";
$email = "";
$name = "";
$city = "";
$location = "";
$store = "";
$errors = array();

//if user signup button
if(isset($_POST['signup'])){
    $name = mysqli_real_escape_string($con, $_POST['name']);
   $email = mysqli_real_escape_string($con, $_POST['email']);

   $password = mysqli_real_escape_string($con, $_POST['password']);
   $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $contact = mysqli_real_escape_string($con, $_POST['contact']);
   $address = mysqli_real_escape_string($con, $_POST['address']);

    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }
    
    $email_check = "SELECT * FROM usertable WHERE email = '$email'";
    $res = mysqli_query($con, $email_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "Email that you have entered is already exist!";
    }
    

    if(count($errors) === 0){
        //$encpass = password_hash($password, PASSWORD_BCRYPT);
        $code = rand(999999, 111111);
        $status = "notverified";
        $insert_data = "INSERT INTO `usertable`(`No`,`name`, `email`, `password`, `contact`, `address`, `code`, `status`) VALUES ('','$name','$email','$password','$contact','$address','$code','$status')";
        $data_check = mysqli_query($con, $insert_data);
        if($data_check){
            $subject = "Email Verification Code";
            $message = "Your verification code is $code";
            $sender = "From: thekppatel@gmail.com";
            if(mail($email, $subject, $message, $sender)){
                $info = "We've sent a verification code to your email - $email";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $email;
               $_SESSION['password'] = $password;
                header('location: user-otp.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }
        else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }
}





//if user click verification code submit button
if(isset($_POST['check'])){
    $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
        $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
        $code_res = mysqli_query($con, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $email = $fetch_data['email'];
            $code = 0;
            $status = 'verified';
            $update_otp = "UPDATE usertable SET code = $code, status = '$status' WHERE code = $fetch_code";
            $update_res = mysqli_query($con, $update_otp);
            if($update_res){
                $_SESSION['name'] = $name;
                $_SESSION['email'] = $email;
                header('location: login-user.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
}

//for login
if(isset($_POST['login'])){
    
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $user_type = mysqli_real_escape_string($con, $_POST['user_type']);

    if($user_type == 'admin'){
        if($email=='admin123@gmail.com' && $password=='admin123@')
        {
            header('location:admin.php');
        }
        else {
            $errors['email'] = "Incorrect email or password!";
        }
         }
    else if($user_type == 'counter_mng'){
            if($email=='counter123@gmail.com' && $password=='counter123@')
            {
                header('location:countermanager.php');
            }
            else {
                $errors['email'] = "Incorrect email or password!";
            }
             }
    else if($user_type == 'customer')
    {
        $check_email = "SELECT * FROM `usertable` WHERE email = '$email'";
        $res = mysqli_query($con, $check_email);
        if(mysqli_num_rows($res) > 0)
        {
            
            $check_pwd = "SELECT * FROM `usertable` WHERE email = '$email' AND password='$password' ";
            $res1 = mysqli_query($con, $check_pwd);
    
            if(mysqli_num_rows($res1) > 0) {
                $check_v = "SELECT * FROM `usertable` WHERE email = '$email' AND status='verified' ";
                $res2 = mysqli_query($con, $check_v);
    
                if(mysqli_num_rows($res2) > 0)
                {
                    $_SESSION['email'] = $email;
                    $_SESSION['password'] = $password;
                    header('location: customerpage.php');
                }
                else {
                    $info = "It's look like you haven't still verify your email - $email";
                    $_SESSION['info'] = $info;
                    header('location: user-otp.php');
                }
    
            }
        }
    }
        else if($user_type == 'deliveryboy')
        {
            $check_email = "SELECT * FROM `delivery_boy` WHERE email = '$email'";
            $res = mysqli_query($con, $check_email);
            if(mysqli_num_rows($res) > 0)
            {
                
                $check_pwd = "SELECT * FROM `delivery_boy` WHERE email = '$email' AND password='$password' ";
                $res1 = mysqli_query($con, $check_pwd);
        
                if(mysqli_num_rows($res1) > 0) {
                    // $check_v = "SELECT * FROM `usertable` WHERE email = '$email' AND status='verified' ";
                    // $res2 = mysqli_query($con, $check_v);
        
                    // if(mysqli_num_rows($res2) > 0)
                    // {
                        $_SESSION['email'] = $email;
                        $_SESSION['password'] = $password;
                        header('location: deliveryboy_dashboard.php');
                    // }
                    // else {
                    //     $info = "It's look like you haven't still verify your email - $email";
                    //     $_SESSION['info'] = $info;
                    //     header('location: user-otp.php');
                    // }
        
                }
            
            else {
                $errors['email'] = "Incorrect email or password!";
            }
       }
    }
    else if($user_type == 'updatemanager') {

        // $check_email2 = "SELECT * FROM `manager` WHERE email = '$email' AND password='$password'";
        $check_email2 = "SELECT * FROM `umtable` WHERE u_email = '$email' AND u_password='$password'";
        // $check_email2 = "SELECT * FROM `usertable` WHERE email = '$email' AND password='$password'";
        $res2 = mysqli_query($con, $check_email2);
        if(mysqli_num_rows($res2) > 0)
        {
            $_SESSION['email'] = $email;
             $_SESSION['password'] = $password;
            header('location: updatemanager.php');
        }
        else {
            $errors['email'] = "Incorrect email or password!";
        }
        
       }

        
    }

        //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $check_email = "SELECT * FROM usertable WHERE email='$email'";
        $run_sql = mysqli_query($con, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE usertable SET code = $code WHERE email = '$email'";
            $run_query =  mysqli_query($con, $insert_code);
            if($run_query){
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $sender = "From: thekppatel30@gmail.com";
                if(mail($email, $subject, $message, $sender)){
                    $info = "We've sent a passwrod reset otp to your email - $email";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $email;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }

   //if user click check reset otp button
   if(isset($_POST['check-reset-otp'])){
    $_SESSION['info'] = "";
    $otp_code = mysqli_real_escape_string($con, $_POST['otp']);
    $check_code = "SELECT * FROM usertable WHERE code = $otp_code";
    $code_res = mysqli_query($con, $check_code);
    if(mysqli_num_rows($code_res) > 0){
        $fetch_data = mysqli_fetch_assoc($code_res);
        $email = $fetch_data['email'];
        $_SESSION['email'] = $email;
        $info = "Please create a new password that you don't use on any other site.";
        $_SESSION['info'] = $info;
        header('location: new-password.php');
        exit();
    }else{
        $errors['otp-error'] = "You've entered incorrect code!";
    }
}

//if user click change password button
if(isset($_POST['change-password'])){
    $_SESSION['info'] = "";
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    if($password !== $cpassword){
        $errors['password'] = "Confirm password not matched!";
    }else{
        $code = 0;
        $email = $_SESSION['email']; //getting this email using session
        //$encpass = password_hash($password, PASSWORD_BCRYPT);
        $update_pass = "UPDATE usertable SET code = $code, password = '$password' WHERE email = '$email'";
        $run_query = mysqli_query($con, $update_pass);
        if($run_query){
            $info = "Your password changed. Now you can login with your new password.";
            $_SESSION['info'] = $info;
            header('Location: password-changed.php');
        }else{
            $errors['db-error'] = "Failed to change your password!";
        }
    }
}

//if login now button click
if(isset($_POST['login-now'])){
    header('Location: login-user.php');
}



if(isset($_POST['Insert'])){
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $location = mysqli_real_escape_string($con, $_POST['location']);
    $store = mysqli_real_escape_string($con, $_POST['store']);
    $u_name =mysqli_real_escape_string($con, $_POST['u_name']);
    $u_age=mysqli_real_escape_string($con, $_POST['u_age']);
    $u_contact=mysqli_real_escape_string($con, $_POST['u_contact']);
    $u_email=mysqli_real_escape_string($con, $_POST['u_email']);
    $u_password=mysqli_real_escape_string($con, $_POST['u_password']);
  //  $id=rand(9999,1111);

    $data_check = "SELECT * FROM storetable WHERE 'location'='$location' AND store_name='$store' ";
    $res = mysqli_query($con, $data_check);
    if(mysqli_num_rows($res) > 0){
        echo '<div class="alert alert-primary" role="alert" style="margin-top:10px; padding:20px;background-color:rgba(255,0,0,0.5);letterspacing:2; ">
		<h1><center>Store that you have entered is already exist!</center></h1>
        </div>';
        // echo "Store that you have entered is already exist!";
        // $errors['store'] = "Store that you have entered is already exist!";
    }
    else{
        if(count($errors) === 0){
            $insert_data = "INSERT INTO `storetable`(`city`, `location`,`store_name`,`id`) VALUES ('$city','$location','$store','')";
            $data_checker = mysqli_query($con, $insert_data);
            $mallid = mysqli_insert_id($con);
            if($data_checker){
            
                $insert_data1 = "INSERT INTO `umtable`(`umid`, `u_name`, `u_age`, `u_contact`, `u_email`, `u_password`) VALUES ('$mallid','$u_name','$u_age','$u_contact','$u_email','$u_password')";
                $data_checker1 = mysqli_query($con, $insert_data1);
                if($data_checker1){

                    $subject = "PricePared.com UpdateManager Password";
                    $message = "Hey $u_name, Your login password is $u_password, use this email: $u_email and given password for login.";
                    $sender = "From: thekppatel@gmail.com";
                    if(mail($u_email, $subject, $message, $sender)){
                        echo "send successfully";
                    }else{
                        $errors['otp-error'] = "Failed while sending code!";
                    }





                $query = mysqli_query($con,"select * from category");
                while($data1 = mysqli_fetch_array($query))
                {
                $p_category = $data1['p_category'];
                $p_name= $data1['p_name'];
                $insert_row_current= "INSERT INTO `current`(`mall_id`, `category`, `product_name`, `price`,`last_date`) VALUES ('$mallid','$p_category','$p_name','Not Available',CURRENT_TIMESTAMP)";
                $data_checker2 = mysqli_query($con, $insert_row_current);
                }



                    header('location: admin.php');
                    echo "send successfully";
                    exit();
                    }
                    else {
                        mysqli_query($con, "DELETE FROM storetable WHERE id = $mallid");
                    }
            }
            else{
                    echo "Failed while inserting data into database!";

                }
        }
        else{
            $errors['db-error'] = "Failed ...";
        }
    }
}

// -----------------------------------------------------------------------------------------------------------
//items part 

if(isset($_POST['add_product'])){

    $product_name = $_POST['product_name'];
   // $product_price = $_POST['product_price'];
    $product_category = $_POST['product_category'];
    $product_image = $_FILES['product_image']['name'];
    $product_image_tmp_name = $_FILES['product_image']['tmp_name'];
    $product_image_folder = 'images/'.$product_image;
 
    if(empty($product_name) || empty($product_category) || empty($product_image)){
       $message[] = 'please fill out all';
    }else{
       //$insert = "INSERT INTO category(p_name, p_category, p_image) VALUES('$product_name', '$product_category', '$product_image')";
       $insert = "INSERT INTO `category`(`PID`, `p_category`, `p_name`, `p_img`) VALUES ('', '$product_category','$product_name','$product_image')";
 
       $upload = mysqli_query($con,$insert);
    //    $id = mysqli_insert_id($con);
       if($upload){
          move_uploaded_file($product_image_tmp_name, $product_image_folder);
          $message[] = 'new product added successfully';
       }else{
          $message[] = 'could not add the product';
       }
       
       $query = mysqli_query($con,"SELECT * FROM storetable");
       while($data3 = mysqli_fetch_array($query))
         {
           $id = $data3['id'];
                 
           $insert_row_current= "INSERT INTO `current`(`mall_id`, `category`, `product_name`, `price`,`last_date`) VALUES ('$id','$product_category','$product_name','Not Available',CURRENT_TIMESTAMP)";
           $data_checker2 = mysqli_query($con, $insert_row_current);
         }

         $query3 = mysqli_query($con,"SELECT * FROM category WHERE p_name='$product_name'");
         $data4 = mysqli_fetch_array($query3);
         $pid= $data4['PID'];

         $qry = "INSERT INTO `categoryhistory`(`PID`, `p_category`, `p_name`, `p_img`, `last_date`, `status`) VALUES ('$pid','$product_category','$product_name','$product_image',CURRENT_TIMESTAMP,'0')";
         $cnt_qry=mysqli_query($con, $qry);
 
         $message[] = 'new product added successfully';
    }
 
 }
 
 if(isset($_GET['delete'])){
    $id = $_GET['delete'];
 
       $try_query = mysqli_query($con,"SELECT * FROM category WHERE PID = '$id'");
       $data4 = mysqli_fetch_array($try_query);
       $pname= $data4['p_name'];
       $pcat= $data4['p_category'];
       $pimg= $data4['p_img'];
 
     $qry = "INSERT INTO `categoryhistory`(`PID`, `p_category`, `p_name`, `p_img`, `last_date`, `status`) VALUES ('$id','$pcat','$pname','$pimg',CURRENT_TIMESTAMP,'2')";
    $cnt_qry=mysqli_query($con, $qry);
    //$qry="UPDATE `categoryhistory` SET `status`='2' WHERE PID='$id'";
    //$cnt_qry=mysqli_query($con, $qry);
    mysqli_query($con, "DELETE FROM category WHERE PID = $id");
    mysqli_query($con, "DELETE FROM current WHERE product_name = '$pname'");
    
    header('location:admin.php');
 }



 if(isset($_POST['add_category'])){

    $product_category = $_POST['product_category'];
 
    if(empty($product_category)){
       $message[] = 'please fill out details';
    }else{
       //$insert = "INSERT INTO category(p_name, p_category, p_image) VALUES('$product_name', '$product_category', '$product_image')";
       $insert = "INSERT INTO `onlycategory`(`index`, `category`) VALUES ('', '$product_category')";
       $upload = mysqli_query($con,$insert);
       if($upload){
          $message[] = 'new category added successfully';
       }else{
          $message[] = 'could not add the category';
       }
 }
}
 



if(isset($_POST['add_delivery_boy'])){

    $name = $_POST['del_name'];
   // $product_price = $_POST['product_price'];
    $email = $_POST['del_email'];
    $pwd = $_POST['pwd'];
    
    if(empty($name) || empty($email) || empty($pwd)){
        $message[] = 'please fill out details';
     }else{
       $insert = "INSERT INTO `delivery_boy`(`name`, `email`, `password`) VALUES ('$name','$email','$pwd')";
       $upload = mysqli_query($con,$insert);
    }

}
 
    
    ?>