<?php

include "../../include/connections.php";


 if($_SERVER['REQUEST_METHOD']=='POST'){

     $orderID=$_POST['orderID'];

     $update="UPDATE bookings SET completion_status = 'Completed' WHERE order_id='$orderID'";
     if(mysqli_query($con,$update)){

         $response['status']=1;
         $response['message']='Confirmed Succefully';

     }else{
         $response['status']=0;
         $response['message']='Please try again';


     }
     echo json_encode($response);
      }
?>