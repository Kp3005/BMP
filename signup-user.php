<?php require_once "controllerUserData.php"; ?>

  

<!DOCTYPE html>
<html>
<head>
	<title>Sign Up Form</title>
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

				<form action="signup-user.php" method="post" autocomplete="">
					<!-- <img src="avatar.jpg"> -->
					<img src="avatar.svg">
				   <h3>Sign Up</h3>


				   <?php
                    if(count($errors) == 1){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }elseif(count($errors) > 1){
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach($errors as $showerror){
                                ?>
                                <li><?php echo $showerror; ?></li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>

				   <input type="text" name="name" required placeholder="enter your name" required value="<?php echo $name ?>">
					<input type="email" name="email" required placeholder="enter your email" required value="<?php echo $email ?>">
					<input type="password" name="password" required placeholder="enter your password">
					<input type="password" name="cpassword" required placeholder="confirm your password">
					<!-- <select name="user_type">
						<option value="user">user</option>
						<option value="admin">admin</option>
					</select> -->
					<input type="text" name="contact" placeholder="enter your contact number">
					<input type="text" name="address" placeholder="enter your address">
					<input type="submit" name="signup" value="Register" class="form-btn">
					<p>already have an account? <a href="login-user.php">login now</a></p>
					<p><button type="reset">Reset</button></p>
				</form>
			 
			 </div>

        </div>
    </div>


</body>
</html>

