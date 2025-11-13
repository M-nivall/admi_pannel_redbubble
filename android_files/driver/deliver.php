<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $orderID=$_POST['orderID'];

     $update="UPDATE bookings SET order_status = '10' WHERE order_id='$orderID'";
     if(mysqli_query($con,$update)){

        $update1="UPDATE shipping SET ship_status = 'Delivered' WHERE order_id='$orderID'";
        mysqli_query($con,$update1);

         $response['status']=1;
         $response['message']='Delivery confirmed, awaiting customer approval';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>