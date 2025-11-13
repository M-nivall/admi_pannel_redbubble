<?php

include "../../include/connections.php";


if($_SERVER['REQUEST_METHOD']=='POST'){

$orderID=$_POST['orderID'];
$paymentID=$_POST['paymentID'];

$update=" UPDATE bookings SET order_status='2' WHERE order_id = '$orderID'";
if(mysqli_query($con,$update)){

    $update1=" UPDATE payment SET status = '2' WHERE order_id = '$orderID' AND payment_id = '$paymentID'";
    mysqli_query($con,$update1);

    $update2=" UPDATE order_items SET item_status = '2' WHERE order_id = '$orderID'";
    mysqli_query($con,$update2);

    $response['status']=1;
    $response['message']='Approved successfully';

}else{
    $response['status']=0;
    $response['message']='Please try again';


}
echo json_encode($response);
}
?>