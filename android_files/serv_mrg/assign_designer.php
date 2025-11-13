<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $orderID=$_POST['orderID'];
     $username=$_POST['username'];
     $tech=$_POST['tech'];


     $select="SELECT * FROM employees WHERE username='$username'";
     $query=mysqli_query($con,$select);
     $row=mysqli_fetch_array($query);

     $empID=$row['emp_id'];
     $assined_date = date("Y-m-d");

     $select1="SELECT * FROM employees WHERE username='$tech'";
     $query1=mysqli_query($con,$select1);
     $row1=mysqli_fetch_array($query1);

     $techID=$row1['emp_id'];
     //$assined_date = date("Y-m-d");

     $update="UPDATE bookings SET order_status = '3' WHERE order_id='$orderID'";
     if(mysqli_query($con,$update)){

         $insert="INSERT INTO design_assignments ( order_id, emp_id,tech_id, date_assigned)VALUES ('$orderID','$empID','$techID','$assined_date')";
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