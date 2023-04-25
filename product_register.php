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

        // Validation for Product Company
        if(!empty($_POST['pcompany']))
        {
            if(!only_text( $_POST['pcompany']))   // Function calling
            {
                $errors[] = "<p>Please enter valid Product Company Name.</p>";
            }
            else
            {
                $pcompany = $_POST['pcompany'];
            }
        }
        else
        {
            $pcompany = null;
            $errors[] = "<p>Product Company Name is required.</p>";
        }

        // Validation for Product Description 
        if(!empty($_POST['pdescription']))
        {
            $pdescription = $_POST['pdescription'];
        }
        else
        {
            $pdescription = null;
            $errors[] = "<p>Product description is required.</p>";
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

        // Validation for Product Quantity
        if(!empty($_POST['pquantity']))
        {
            if(!preg_match('/^[0-9]*$/', $_POST['pquantity']))   // Function calling
            {
                $errors[] = "<p>Please enter valid Product Quantity.</p>";
            }
            else
            {
                $pquantity = $_POST['pquantity'];
            }
        }
        else
        {
            $pquantity = null;
            $errors[] = "<p>Product Quantity is required.</p>";
        }

        // Validation for Product user
        if(!empty($_POST['product_user']))
        {
            if(!only_text($_POST['product_user']))  // Function calling
            {
                $errors[] = "<p>Please enter valid name of Product's User.</p>";
            }
            else
            {
                $product_user = $_POST['product_user'];
            }
        }
        else
        {
            $product_user = null;
            $errors[] = "<p>Name of Product's User is required.</p>";
        }

        if(count($errors) == 0)
        {
            $productName_clean = prepare_string($dbc, $pname);
            $productCompany_clean = prepare_string($dbc, $pcompany);
            $productPrice_clean = prepare_string($dbc, $pprice);
            $productQuantity_clean = prepare_string($dbc, $pquantity);
            $productDescription_clean = prepare_string($dbc, $pdescription);
            $productUser_clean = prepare_string($dbc, $product_user);

            $query = "INSERT INTO products(pname, pcompany, pquantity, pprice, pdescription, product_user) VALUES (?,?,?,?,?,?)";
            $statement = mysqli_prepare($dbc, $query);

            mysqli_stmt_bind_param(
                $statement,
                'ssssss',
                $productName_clean,
                $productCompany_clean,
                $productPrice_clean,
                $productQuantity_clean,
                $productDescription_clean,
                $productUser_clean
            );

            $result = mysqli_stmt_execute($statement);
        
            if($result){
                header("Location: product_detail.php");
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

        // Function for checking text only
        function only_text($input){
            if(!preg_match("/[^a-zA-Z- ]/", $input)) 
            {
                return true;
            } else 
            { 
                return false;
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