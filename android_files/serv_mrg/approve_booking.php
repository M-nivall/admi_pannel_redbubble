<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $orderID=$_POST['orderID'];
     $clientID=$_POST['clientID'];
     $service_fee=$_POST['service_fee'];

     $update="UPDATE bookings SET order_status='2' WHERE order_id='$orderID'";
     if(mysqli_query($con,$update)){

         $insert="INSERT INTO service_payment ( order_id, client_id, service_fee)VALUES ('$orderID','$clientID', '$service_fee')";
         mysqli_query($con,$insert);

         $response['status']=1;
         $response['message']='Submited Successfully';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>