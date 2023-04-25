<?php
    include 'conn.php';
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
<header class="header">
   <a href="#"><img src="img/store.png" class="logo" alt=""></a>
   <div>
      <ul class="navbar">
         <li><a href="admin.php">New Product</a></li>
         <li><a href="product_detail.php">Product Details</a></li>
         <li><a href="logout.php" class="btn">logout</a></li>
      </ul>
   </div>
</header>
   
<div class="container">
   <div class="content">
      <br><br>
      <h3>Hello, <span><?php echo $_SESSION['admin_name'] ?></span></h3>
      <h1>welcome to the Admin page</h1>
   </div>
</div>

<div class="form-container2">
    <?php
    require('product_conn.php');
    $errors = [];

        if(count($errors) == 0){
            
            $pid_clean = prepare_string($dbc, $pid);
            $pname_clean = prepare_string($dbc, $pname);
            $pcompany_clean = prepare_string($dbc, $pcompany);
            $pprice_clean = prepare_string($dbc, $pprice);
            $pquantity_clean = prepare_string($dbc, $pquantity);            
            $productDescription_clean = prepare_string($dbc, $pdescription);
            $product_user_clean = prepare_string($dbc, $product_user);
            
            $query = "UPDATE products SET pname = ?, pcompany = ?, pprice = ?, pquantity = ?, pdescription = ?, product_user = ? WHERE  pid = ?;";
            
            $statement = mysqli_prepare($dbc, $query);
            
            mysqli_stmt_bind_param(
                $statement,
                'sssssss',
                $pname_clean,
                $pcompany_clean,
                $pprice_clean,
                $pquantity_clean,
                $productDescription_clean,
                $product_user_clean,
                $pid_clean
            );
            
            $result = mysqli_stmt_execute($statement);
            
            if($result){
                header("Location: buy_product.php");
                exit;
            } else {
                echo "</br>Some error in Saving the data";
            }
            
        } 
        else {
            foreach($errors as $error){
                echo '</br><span class="error2">'.$error.'</span>';
            }
        }
    ?>
</div>

<footer class="footer">
   <div class="footertext">
      <h4>Get E-mail updates about our latest products and <span>special offers</span>.</h4>
      <br>
      <p>Created by &copy;PHP Pirates</p>
      <p>Email : PHP_Pirates@gmail.com</p>
      <p>Mobile No. : +1(123)-456-7890</p>
      <p>Group Members : Yashkumar Patel, Vishwa Patel, Twaran Sahai</p>
   </div>
</footer>
</body>
</html>