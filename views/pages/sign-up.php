<br><br><br>
<?php

// Creating new user instance
$newUser = new UserController(); 

// Define variables and initialize with empty values
$username_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else {
    	// Setting username
    	$newUser->setUsername($_POST["username"]);
    	// Checking username for existence
        if($newUser->checkForExistenceByUsername()){
          $username_err = "This username is already taken.";
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have at least 6 characters.";
    } else{
    	$newUser->setPassword($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $newUser->setConfirmPassword($_POST["confirm_password"]);
        echo "Confirmpass:";
        print_r($newUser->matchConfirmPassword());
        if(empty($password_err) && !$newUser->matchConfirmPassword()){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){ 
            if($newUser->create()){          
            	header("location: /login");
            } else{
                echo "Something went wrong. Please try again later.";
            }
    }
    
}
?>
 
<div class="container">
	<h2>Sign Up</h2>
	<p>Please fill this form to create an account.</p>
	<form action="<?php echo "/".$currentPage; ?>" method="post">
		<div class="form-group <?php echo (!empty($username_err)) ? 'has-danger' : ''; ?>">
			<label>Username</label>
			<input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $newUser->getUsername(); ?>">
			<span class="invalid-feedback"><?php echo $username_err; ?></span>
		</div>    
		<div class="form-group <?php echo (!empty($password_err)) ? 'has-danger' : ''; ?>">
			<label>Password</label>
			<input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="">
			<span class="invalid-feedback"><?php echo $password_err; ?></span>
		</div>
		<div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-danger' : ''; ?>">
			<label>Confirm Password</label>
			<input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="">
			<span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
		</div>
		<div class="form-group">
			<input type="submit" class="btn btn-primary" value="Submit">
			<input type="reset" class="btn btn-default" value="Reset">
		</div>
		<p>Already have an account? <a href="login.php">Login here</a>.</p>
	</form>
</div>    
