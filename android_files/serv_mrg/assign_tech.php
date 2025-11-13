<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $orderID=$_POST['orderID'];
     $username=$_POST['username'];
     $pdf_design=$_POST['pdf_design'];


     $select="SELECT * FROM employees WHERE username='$username'";
     $query=mysqli_query($con,$select);
     $row=mysqli_fetch_array($query);

     $empID=$row['emp_id'];
     $assined_date = date("Y-m-d");

     $update="UPDATE bookings SET order_status = '7' WHERE order_id='$orderID'";
     if(mysqli_query($con,$update)){

         $insert="INSERT INTO tech_assignments ( order_id, emp_id, pdf_design, date_assigned)VALUES ('$orderID','$empID', '$pdf_design','$assined_date')";
         mysqli_query($con,$insert);

         $response['status']=1;
         $response['message']='Assined Succefully';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>