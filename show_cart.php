<?php
   require('product_conn.php');

   $query = 'SELECT * FROM cart;';
   $results = @mysqli_query($dbc,$query); 

      if(isset($_POST['submit'])){
        $error = [];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mnumber = $_POST['mnumber'];
        $email = $_POST['email'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $province = $_POST['province'];
        $zcode = $_POST['zcode'];
        $country = $_POST['country'];
        $cnumber = $_POST['cnumber'];
        $cmonth = $_POST['cmonth'];
        $cyear = $_POST['cyear'];
        $cvv = $_POST['cvv'];
        $notes = $_POST['notes'];

        // First name 
        if(empty($_POST['fname']))
        {
            $error[] = "<p>First name is required.</p>";
        }

        // Last name
        else if(empty($_POST['lname']))
        {
            $error[] = "<p>Last name is required.</p>";
        }

        // Mobile number
        else if(empty($_POST['mnumber']))
        {
            $error[] = "<p>Mobile number is required.</p>";
        }

        // Email
        else if(empty($_POST['email']))
        {
            $error[] = "<p>Email is required.</p>";
        }

        // Street
        else if(empty($_POST['street']))
        {
            $error[] = "<p>Street name is required.</p>";
        }
        
        // City
        else if(empty($_POST['city']))
        {
            $error[] = "<p>City name is required.</p>";
        }

        // Province
        else if(empty($_POST['province']))
        {
            $error[] = "<p>Province name is required.</p>";
        }
        
        // Postal code
        else if(empty($_POST['zcode']))
        {
            $error[] = "<p>Postal code is required.</p>";
        }

        // Country
        else if(empty($_POST['country']))
        {
            $error[] = "<p>Country name is required.</p>";
        }
        
        // Card number
        else if(empty($_POST['cnumber']))
        {
            $error[] = "<p>Card number is required.</p>";
        }

        // Card month
        else if(empty($_POST['cmonth']))
        {
            $error[] = "<p>Card month is required.</p>";
        }
        
        // Card year
        else if(empty($_POST['cyear']))
        {
            $error[] = "<p>Card year is required.</p>";
        }
        
        // CVV code
        else if(empty($_POST['cvv']))
        {
            $error[] = "<p>cvv code is required.</p>";
        }

        // Notes
        else if(empty($_POST['notes']))
        {
            $error[] = "<p>Note is required.</p>";
        }

        else{
            $insert_query = "INSERT INTO customer(fname, lname, mnumber, email, street, city, province, zcode, country, cnumber, cmonth, cyear, cvv, notes ) 
                    VALUES ('$fname', '$lname', '$mnumber', '$email', '$street', '$city', '$province', '$zcode', '$country', '$cnumber', '$cmonth', '$cyear', '$cvv', '$notes')";
            mysqli_query($dbc, $insert_query);
            header('location:invoice.php');
        }


   };
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
      <h1>welcome to our Mobile Planet online store.</h1>
      <br><br>
   </div>

   <div class="form-container3">
        <table class="content-table3">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_array($results, MYSQLI_ASSOC)){
                        $str_to_print = "";
                        $str_to_print = "<tr> <td>{$row['pid']}</td>";
                        $str_to_print .= "<td>{$row['pname']}</td>";
                        $str_to_print .= "<td>{$row['pprice']}</td>";                        
                        $str_to_print .= "<td> <a href='remove_product_cart.php?pid={$row['pid']}' style='color:crimson;'>Remove</a> </td> </tr>";
                        echo $str_to_print;
                    }
                ?>
            </tbody>
        </table>
        <div class="content">
            <br><br>
               <h2>Please enter your personal details.</h2>
            <br><br>
         </div>

         <form action="" method="post">
               <?php 
                  if(isset($error)){
                        foreach($error as $error){
                           echo '<span class="error">'.$error.'</span>';
                        }
                  }
               ?>
               <label>First Name</label>
               <input type="text" name="fname"  placeholder="enter your first name">
               <label>Last Name</label>
               <input type="text" name="lname"  placeholder="enter your last name">
               <label>Mobile No.</label>
               <input type="text" name="mnumber"  placeholder="enter your mobile number">
               <label>Email</label>
               <input type="text" name="email"  placeholder="enter your email address">
               <label>Address</label>
               <input type="text" name="street"  placeholder="enter your street address">
               <input type="text" name="city"  placeholder="enter your city">
               <select name="province">
                  <option>select your Province</option>
                  <option value="Ontario">Ontario</option>
                  <option value="Quebec">Quebec</option>
                  <option value="Alberta">Alberta</option>
                  <option value="Manitoba">Manitoba</option>
                  <option value="Nova Scotia">Nova Scotia</option>
                  <option value="British Columbia">British Columbia</option>
                  <option value="Saskatchewan">Saskatchewan</option>
                  <option value="New Brunswick">New Brunswick</option>
                  <option value="Prince Edward Island">Prince Edward Island</option>
                  <option value="Newfoundland and Labrador">Newfoundland and Labrador</option>
                  <option value="Nunavut">Nunavut</option>
                  <option value="Northwest Territories">Northwest Territories</option>
                  <option value="Yukon">Yukon</option>
               </select>
               <input type="text" name="zcode"  placeholder="enter your Zip code">
               <input type="text" name="country"  placeholder="enter your country">
               <br></br>
               <label><h1>Please enter your card details</h1></label>
               <label>Card No.</label>
               <input type="password" name="cnumber"  placeholder="****  ****  ****  ****">
               <label>Expiration Date</label>
               <input type="password" name="cmonth"  placeholder="MM">
               <input type="password" name="cyear"  placeholder="YYYY">
               <label>CVV No.</label>
               <input type="password" name="cvv"  placeholder="***">
               <br></br>
               <label><h1>Any notes</h1></label>
               <textarea name="notes" placeholder="Please enter any notes"></textarea>

            <input type="submit" name="submit" value="Submit" class="form-btn">
         </form>
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