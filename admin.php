<?php
include 'conn.php';
session_start();

if(!isset($_SESSION['admin_name'])){
   header('location:login.php');
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

   <form action="product_register.php" method="post">
      <label>Product Name</label>
      <input type="text" name="pname"  placeholder="enter your product name">
      <label>Product Company</label>
      <input type="text" name="pcompany"  placeholder="enter your product company">
      <label>Product Price</label>
      <input type="text" name="pprice"  placeholder="enter your product price">
      <label>Product Quantity</label>
      <input type="text" name="pquantity"  placeholder="enter your product quantity">
      <label>Product Description</label>
      <textarea name="pdescription" placeholder="enter your product description"></textarea>
      <label>Product Added by</label>
      <select name="product_user">
        <option>select user</option>
        <option value="yash">Yash</option>
        <option value="vishwa">Vishwa</option>
        <option value="Twaran">Twaran</option>
      </select>
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