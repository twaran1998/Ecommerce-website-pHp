<?php

    require("../fpdf185/fpdf.php");
    $connection = mysqli_connect('localhost','root','','product');
    require('product_conn.php');

    class PDF extends FPDF{
        function Header()
        {
            $this->Image("../Demo_Project/img/store.png",90,10,30);
            $this->Ln(10);
            $this->SetFont('Arial','B',20); 
            $this->Cell(80); 
            $this->Cell(30,55,'MOBILE PLANET',0,0,'C');            
            $this->Ln();    
            $this->Cell(80);         
            $this->Cell(30,-20,'Invoice',0,0,'C');            
        }
        function Footer()
        {
            $this->Image("../Demo_Project/img/stamp.png",95,250,20);
            $this->Cell(80); 
            $this->SetY(-15);
            $this->SetFont('Arial','B',10);
            $this->Cell(0,10,$this->PageNo(),0,0,'C');
        }
    }
    

    $pdf = new PDF();
    $pdf->addPage();

    $query1 = mysqli_query($connection,"SELECT * FROM cart;");
    $result1 = mysqli_fetch_array($query1);
    $query2 = mysqli_query($connection,"SELECT * FROM customer;");
    $result2 = mysqli_fetch_array($query2);

    $pdf->SetFont('Arial','',14);
    $pdf->Cell(10);
    // Company's address
    $pdf->Cell(150,5,'[299, Doon Vally Dr]',0,0);
    $pdf->Cell(59,6,'',0,1);
    $pdf->Cell(120);
    $pdf->Cell(130,5,'[Kitchener, Canada, N2G 4M4]',0,0);
    $pdf->Ln();
    $pdf->Cell(120);
    $pdf->Cell(17,7,'Date :',0,0);
    $date = date("Y-m-d");
    $pdf->Cell(25,7,$date,0,1);
    $pdf->Cell(120);
    $pdf->Cell(0,5,'Phone [+12345678]',0,0);
    $pdf->Ln(10);

    //billing address
    $pdf->SetFont('Arial','B',18);
    $pdf->Cell(0,5,'Bill to : ',0,1);
    $pdf->Ln();
        foreach($query2 as $rows)
        {
            $customer_name=$rows['fname'];
            $customer_email=$rows['email'];
            $customer_street=$rows['street'];
            $customer_city=$rows['city'];
            $customer_province=$rows['province'];
            $customer_zcode=$rows['zcode'];
            $customer_cnumber=$rows['cnumber'];
            
            $pdf->SetFont('Arial','',14);
            $pdf->Cell(0,5,'Name : ',0,0);    
            $pdf->Cell(-165);
            $pdf->Cell(0,6,$customer_name,0,1);

            $pdf->Cell(0,5,'Email : ',0,0);    
            $pdf->Cell(-165); 
            $pdf->Cell(0,6,$customer_email,0,1);

            $pdf->Cell(0,5,'Address : ',0,0);    
            $pdf->Cell(-165);
            $pdf->Cell(0,6, $customer_street,0,1);
            $pdf->Cell(25);
            $pdf->Cell(0,6, $customer_city,0,1);
            $pdf->Cell(25);
            $pdf->Cell(0,6, $customer_province,0,1);
            $pdf->Cell(25);
            $pdf->Cell(0,6, $customer_zcode,0,1);

            $pdf->Cell(0,5,'Mobile : ',0,0);    
            $pdf->Cell(-165);
            $pdf->Cell(0,6, $customer_cnumber,0,1);
        }

    // Product detail
    $pdf->Ln(20);    
    $pdf->SetFont('Arial','B',18);
    $pdf->Cell(0,5,'Product Information : ',0,1);
    $pdf->Ln();
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(35,8,'Product Id.',1,0,'C');
    $pdf->Cell(85,8,'Product Name',1,0,'C');
    $pdf->Cell(35,8,'Price',1,0,'C');
    $pdf->Cell(35,8,'Amount',1,0,'C');

    $pdf->SetFont('Arial','',12);
    $total_price = 0;

    $pdf->Ln();
    foreach($query1 as $rows)
    {
        $item_id=$rows['pid'];
        $item_name=$rows['pname'];
        $item_price=$rows['pprice'];
        $individual_price=$rows['pprice'];
        $item_tax=10;
        $total_price += $item_price;
        $pdf->Cell(35	,7, $item_id,1,0,'C');
        $pdf->Cell(85	,7, $item_name,1,0,'C');
        $pdf->Cell(35	,7, $individual_price,1,0,'C');
        $pdf->Cell(35	,7, $item_price,1,1,'C');
    }
      
    // Final Price
    $pdf->Ln();
    $pdf->Cell(130	,5,'',0,0);
    $pdf->Cell(25	,7,'Subtotal',0,0);
    $pdf->Cell(5	,7,'$',1,0);
    $pdf->Cell(30	,7,$total_price,1,1,'C');
    // Tax
    $pdf->Cell(130	,5,'',0,0);
    $pdf->Cell(25	,7,'Tax Rate',0,0);
    $pdf->Cell(35	,7,'13%',1,1,'C');
    // Calculating tax
    $temp = 0.13;
    $total_due = 0;
    $total_due = ($total_price * $temp) + $total_price;
    $pdf->Cell(130	,5,'',0,0);
    $pdf->Cell(25	,7,'Total Due',0,0);
    $pdf->Cell(5	,7,'$',1,0);
    $pdf->Cell(30	,7,$total_due,1,1,'C');

    $pdf->Output();
?>