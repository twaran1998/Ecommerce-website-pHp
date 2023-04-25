<?php
include 'conn.php';
require('product_conn.php');
session_start();

    if(!isset($_SESSION['admin_name'])){
    header('location:login.php');
    }

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
            $pquantity = $row['pquantity'];
            $pdescription = $row['pdescription'];
            $product_user = $row['product_user'];
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

<div class="form-container">

   <form action="update_product.php" method="post">
      <h3>Please enter the data you want to edit for your product</h3>
      <input type="hidden" name="pid" value="<?php echo $pid; ?>">
      <label>Product Name</label>
      <input type="text" name="pname"  value="<?php echo $pname; ?>">
      <label>Product Company</label>
      <input type="text" name="pcompany"  value="<?php echo $pcompany; ?>">
      <label>Product Quantity</label>
      <input type="text" name="pprice"  value="<?php echo $pprice; ?>">
      <label>Product Price</label>
      <input type="text" name="pquantity"  value="<?php echo $pquantity; ?>">
      <label>Product Description</label>
      <textarea name="pdescription" placeholder="enter your product description" value="<?php echo $pdescription; ?>"></textarea>
      <label>Product Added by</label>
      <select name="product_user">
        <option value="<?php echo $product_user; ?>">select user</option>
        <option value="yash">Yash</option>
        <option value="vishwa">Vishwa</option>
        <option value="Twaran">Twaran</option>
      </select>
      <input type="submit" name="submit" value="Update Please!" class="form-btn">
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