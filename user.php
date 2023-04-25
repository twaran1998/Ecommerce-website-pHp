<?php
   include 'conn.php';
   require('product_conn.php');

   session_start();

   if(!isset($_SESSION['user_name'])){
      header('location:login.php');
   }

   $query = 'SELECT * FROM products;';
   $results = @mysqli_query($dbc,$query);
?>

<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user page</title>

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
   
<div class="container2">
   <div class="content">
      <br><br>
      <h3>Hello, <span><?php echo $_SESSION['user_name'] ?></span></h3>
      <h1>welcome to our Mobile Planet online store.</h1>
      <br><br>
   </div>

   <div class="form-container3">
        <table class="content-table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Company</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>User</th>
                    <th>View</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
                        $str_to_print = "";
                        $str_to_print = "<tr> <td>{$row['pid']}</td>";
                        $str_to_print .= "<td>{$row['pname']}</td>";
                        $str_to_print .= "<td>{$row['pcompany']}</td>";
                        $str_to_print .= "<td>{$row['pquantity']}</td>";
                        $str_to_print .= "<td>{$row['pprice']}</td>";
                        $str_to_print .= "<td>{$row['product_user']}</td>";
                        $str_to_print .= "<td> <a href='user_product_detail.php?pid={$row['pid']}' style='color:crimson;'>Details</a> </td> </tr>";
                    
                        echo $str_to_print;
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>

<footer class="footer">
   <div class="footertext">
      <h4>Get E-mail updates about our latest products and special offers.</h4>
      <br>
      <p>Created by &copy;PHP Pirates</p>
      <p>Email : PHP_Pirates@gmail.com</p>
      <p>Mobile No. : +1(123)-456-7890</p>
      <p>Group Members : Yashkumar Patel, Vishwa Patel, Twaran Sahai</p>
   </div>
</footer>
</body>
</html>