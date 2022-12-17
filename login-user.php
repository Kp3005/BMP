<?php require_once "controllerUserData.php"; ?>


<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="wave.png">
	<div class="container">
		<div class="img">
			<img src="bg.svg">
		</div>
		<div class="login-content">
			<div class="form-container">
				<form action="login-user.php" method="post" autocomplete="">      
					<!-- <img src="avatar.jpg"> -->
					<img src="avatar.svg">
				   <h3>login now</h3>

				   <?php
                    if(count($errors) > 0){
                        ?>
                        <div style="font-size: large; color:#2dcf95; margin-top: 13px; padding: 10px; background-color: #1d1b1b">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
					


				   <input type="email" name="email" required placeholder="enter your email" required value="<?php echo $email ?>">
				   <input type="password" name="password" required placeholder="enter your password" required>

				   <select name="user_type">
						<option value="customer">customer</option>
						<option value="updatemanager">Update Manager</option>
						<option value="admin">admin</option>
						<option value="counter_mng">Counter Manager</option>
						<option value="deliveryboy">Delivery Boy</option>
					</select>

					<p><a href="forgot-password.php">Forgot password?</a></p>


				   <input type="submit" name="login" value="login" class="form-btn">
				   <p>don't have an account? <a href="signup-user.php">register now</a></p>
				   <p><button type="reset">Reset</button></p>
				  <sup> <a href="MAIN_FRONT.html">Back to Homepage</a></sup>
				</form>
				
			 
			 </div>

        </div>
    </div>
    <!-- <script type="text/javascript" src="js/main.js"></script> -->
</body>
</html>
