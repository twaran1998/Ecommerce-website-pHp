<?php
include 'conn.php';
session_start();

if(isset($_POST['submit'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['cpassword'];
    $user_type = $_POST['user_type'];

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);

        if($row['user_type'] == 'user'){
            $_SESSION['user_name'] = $row['name'];
            header('location:user.php');
        }
        else if($row['user_type'] == 'admin'){
            $_SESSION['admin_name'] = $row['name'];
            header('location:admin.php');
        }
    }
    else{
        $error[] = 'Incorrect email or password.';
    }
};
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Welcome to Login page</h3>
      <br>
      <?php 
        if(isset($error)){
            foreach($error as $error){
                echo '<span class="error">'.$error.'</span>';
            }
        }
      ?>
      <label>Email</label>
      <input type="email" name="email" required placeholder="enter your email">
      <label>Password</label>
      <input type="password" name="password" required placeholder="enter your password">
      <input type="submit" name="submit" value="Login" class="form-btn">
      <p>You don't have an account? <a href="register.php">Register now</a></p>
   </form>

</div>

</body>
</html>