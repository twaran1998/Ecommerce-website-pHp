<?php
require('product_conn.php');

    $error = null;
    if(!empty($_GET['pid']))
    {
        $pid = $_GET['pid'];
    }

    if($error == null){
        $query = "SELECT * FROM products WHERE pid = $pid;";
        $result = @mysqli_query($dbc, $query);
            
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $pid = $row['pid'];
            $pname = $row['pname'];
            $pprice = $row['pprice'];
            $pquantity = $row['pquantity'];
        }
    }

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
         <li><a href="user.php">Product Detail</a></li>
         <li><a href="buy_product.php">Buy Product</a></li>
         <li><a href="show_cart.php">Cart</a></li>
         <li><a href="logout.php" class="btn">logout</a></li>
      </ul>
   </div>
</header>
   
<div class="container">
   <div class="content">
      <br><br>
      <h1>welcome to our Mobile Planet online store.</h1>
   </div>
</div>

<div class="form-container4">

   <form action="cart.php" method="post">
      <h3>You have selected <?php echo $pname; ?></h3>
      <input type="hidden" name="pid" value="<?php echo $pid; ?>" >
      <label>Product Name</label>
      <input type="text" name="pname"  value="<?php echo $pname; ?>" >
      <label>Product Price</label>
      <input type="text" name="pprice"  value="<?php echo $pquantity; ?>" >
      <input type="submit" name="add_to_cart" value="Add to cart" class="form-btn">
   </form>

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