<?php
require('product_conn.php');

    $error = null;
    if(!empty($_GET['pid']))
    {
        $pid = $_GET['pid'];
    } 
    else 
    {
        $pid = null;
        $error = "<p> Error! The Product Id that you entered is not found.";
    }

    if($error == null){
        $query = "SELECT * FROM products WHERE pid = $pid;";
        $result = @mysqli_query($dbc, $query);
            
        if(mysqli_num_rows($result) == 1)
        {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $pid = $row['pid'];
            $pname = $row['pname'];
            $pcompany = $row['pcompany'];
            $pprice = $row['pprice'];
            $pdescription = $row['pdescription'];
            $pquantity = $row['pquantity'];
        }
    } 
    else 
    {
        echo $error;
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

<div class="form-container">

   <form action="details_product_user.php" method="post">
      <h3>You have selected <?php echo $pname; ?></h3>
      <input type="hidden" name="pid" value="<?php echo $pid; ?>">
      <label>Product Name</label>
      <input type="text" name="pname"  value="<?php echo $pname; ?>" disabled>
      <label>Product Company</label>
      <input type="text" name="pcompany"  value="<?php echo $pcompany; ?>" disabled>
      <label>Product Price</label>
      <input type="text" name="pquantity"  value="<?php echo $pquantity; ?>" disabled>
      <label>Product Description</label>
      <input type="text" name="pdescription" value="<?php echo $pdescription ?>" disabled>
      <input type="submit" name="submit" value="Submit" class="form-btn">
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