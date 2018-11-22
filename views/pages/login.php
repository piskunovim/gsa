<br><br><br>
<?php

// Check if the user is already logged in, if yes then redirect him to user page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: /user");
    exit;
}

// Creating new user instance
$loginUser = new UserController(); 
 
// Define variables and initialize with empty values
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $loginUser->setUsername($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){

        //print_r($loginUser->authenticate());  
        $userData = $loginUser->get();
        if($userData){
            if($loginUser->matchPasswords($_POST["password"], $userData['password'])){
                // Password is correct, so start a new session
                session_start();

                // Store data in session variables
                $_SESSION["loggedin"] = true;
                $_SESSION["id"] = $userData['id'];
                $_SESSION["username"] = $userData['username']; 
                $_SESSION["permission"] = $userData['permission'];

                // Redirect user to welcome page
                header("location: /");
            } else {
                // Display an error message if password is not valid
                $password_err = "The password you entered was not valid.";
            }
        } else {
                    // Display an error message if username doesn't exist
            $username_err = "No account found with that username.";
        }

    }
    
}
?>
 

<div class="container">
    <h2>Login</h2>
    <p>Please fill in your credentials to login.</p>
    <form action="<?php echo "/".$currentPage; ?>" method="post">
        <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
            <label>Username</label>
            <input type="text" name="username" class="form-control" value="<?php echo $loginUser->getUsername(); ?>">
            <span class="help-block"><?php echo $username_err; ?></span>
        </div>    
        <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
            <label>Password</label>
            <input type="password" name="password" class="form-control">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" class="btn btn-primary" value="Login">
        </div>
        <p>Don't have an account? Please, email us: <?php echo CONST_EMAIL; ?> .</p>
    </form>
</div>



