<!DOCTYPE html>
<html>
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>User page</title>

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
      <h1>welcome to the User page</h1>
   </div>
</div>

<div class="form-container2">

    <?php
        require("product_conn.php");
        $errors = [];
        $pricePattern = '/^(0|[1-9]\d*)(\.\d{2})?$/';

        // Validation for Product Name
        if(!empty($_POST['pname']))
        {
            $pname = $_POST['pname'];
        }
        else
        {
            $pname = null;
            $errors[] = "<p>Product name is required.</p>";
        }

        // Validation for Product Price
        if(!empty($_POST['pprice']))
        {
            if(preg_match($pricePattern, $_POST['pprice'])=='0')    // Function calling
            {
                $errors[] = "<p>Please enter valid Product Price.</p>";
            }
            else
            {
                $pprice = $_POST['pprice'];
            }
        }
        else
        {
            $pprice = null;
            $errors[] = "<p>Product Price is required.</p>";
        }

        if(count($errors) == 0)
        {
            $productName_clean = prepare_string($dbc, $pname);
            $productPrice_clean = prepare_string($dbc, $pprice);

            $query = "INSERT INTO cart(pname, pprice) VALUES (?,?)";
            $statement = mysqli_prepare($dbc, $query);

            mysqli_stmt_bind_param(
                $statement,
                'ss',
                $productName_clean,
                $productPrice_clean
            );

            $result = mysqli_stmt_execute($statement);
        
            if($result){
                header("Location: user.php");
                exit;
            } else {
                echo "</br>Some error in Saving the data.";
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