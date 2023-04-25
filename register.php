<?php
include 'conn.php';

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['cpassword'];
    $user_type = $_POST['user_type'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    
    /* For name */
    if(!only_text($_POST['name']))    // Function calling
    {
       $error[] = 'Please enter valid name.';
    }
    /* For email */
    else if(!valid_email($_POST['email']))    // Function calling
    {
       $error[] = 'Please enter valid email address.';
    }
    /* For password matching */
    else if($password != $confirmPassword){
        $error[] = 'Passwords are not matching with each other.';
    }
    /* For user checking */
    else if(mysqli_num_rows($result) > 0){
        $error[] = 'This user is already exists.';
    }
    /* Inserting the data */
    else{
        $insert_query = "INSERT INTO users(name, email, password, user_type) VALUES ('$name', '$email', '$password', '$user_type')";
        mysqli_query($conn, $insert_query);
        header('location:login.php');
    }
};
function valid_email($input){
    if(filter_var($input, FILTER_VALIDATE_EMAIL)) 
    {
        return true;
    } else 
    {
        return false;
    }
};
function only_text($input){
    if(!preg_match("/[^a-zA-Z- ]/", $input)) 
    {
        return true;
    } else 
    { 
        return false;
    }
};
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>registration page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Welcome to Registration page</h3>
      <?php 
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error">'.$error.'</span>';
            }
        }
      ?>
      <br>
      <label>Name</label>
      <input type="text" name="name" required placeholder="enter your name">
      <label>Email</label>
      <input type="email" name="email" required placeholder="enter your email">
      <label>Password</label>
      <input type="password" name="password" required placeholder="enter your password">
      <label>Confirm Password</label>
      <input type="password" name="cpassword" required placeholder="confirm your password">
      <label>User type</label>
      <select name="user_type">
        <option>select user type</option>
        <option value="user">user</option>
        <option value="admin">admin</option>
      </select>
      <input type="submit" name="submit" value="Register" class="form-btn">
      <p>already have an account? <a href="login.php">login now</a></p>
   </form>

</div>

</body>
</html>