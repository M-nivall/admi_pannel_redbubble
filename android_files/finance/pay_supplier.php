<?php

include "../../include/connections.php";


if($_SERVER['REQUEST_METHOD']=='POST'){

$id=$_POST['id'];
$requestID=$_POST['requestID'];

$update="UPDATE supply_payment SET payment_status='Paid' WHERE id='$id'";
  
  
$update2="UPDATE supply_bids SET bid_status = 'Paid' WHERE request_id='$requestID'";
    mysqli_query($con,$update2);
if(mysqli_query($con,$update)){

    $response['status']=1;
    $response['message']='Supplier Paid';

}else{
    $response['status']=0;
    $response['message']='Please try again';


}
echo json_encode($response);
}
?>