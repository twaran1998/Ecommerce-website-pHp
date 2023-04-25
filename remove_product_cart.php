<?php
    require('product_conn.php');

    $error = null;

    if(!empty($_GET['pid'])){
        $pid = $_GET['pid'];
    } else {
        $pid = null;
        $error = "<p> Error! The Product Id that you entered is not found. </p>";
    }

    if($error == null){
        
        $query = "DELETE FROM cart WHERE pid = '$pid';";
        
        $result = mysqli_query($dbc, $query);
        
        if($result){
            header("Location: show_cart.php");
            exit;
        } else {
            echo "</br><p>Some error in Deleting the record</p>";
        }
        
    } 
    else{
        echo "Somethinng went wrong. The error is : $error";
    }
?>