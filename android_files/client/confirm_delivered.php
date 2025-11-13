<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $orderID=$_POST['orderID'];
     $clientID=$_POST['clientID'];
     $rating=$_POST['rating'];

     $update="UPDATE bookings SET order_status = '11', rating = '$rating' WHERE order_id='$orderID'";
     if(mysqli_query($con,$update)){

        $update1="UPDATE shipping SET ship_status = 'Completed' WHERE order_id='$orderID'";
        mysqli_query($con,$update1);

         $response['status']="success";
         $response['message']='Thanks for shopping with Redbubble';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>