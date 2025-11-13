<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $orderID=$_POST['orderID'];
     $username=$_POST['username'];
     $clientName=$_POST['clientName'];
     $phoneNo=$_POST['phoneNo'];
     $email=$_POST['email'];


     $select="SELECT * FROM employees WHERE username='$username'";
     $query=mysqli_query($con,$select);
     $row=mysqli_fetch_array($query);

     $empID=$row['emp_id'];
     $assined_date = date("Y-m-d");

     $update="UPDATE bookings SET order_status = '9' WHERE order_id='$orderID'";
     if(mysqli_query($con,$update)){

         $insert="INSERT INTO shipping ( order_id, driver_id, client_name, phone, email )VALUES ('$orderID','$empID','$clientName','$phoneNo','$email')";
         mysqli_query($con,$insert);

         $response['status']=1;
         $response['message']='Driver Assigned Successfully';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>