<?php

include "../../include/connections.php";


if($_SERVER['REQUEST_METHOD']=='POST'){

$id=$_POST['requestID'];
$bidID=$_POST['bidID'];
$color=$_POST['color'];

$update="UPDATE supply_bids SET bid_status = 'Confirmed Supply' WHERE bid_id = '$bidID' ";


$sel="SELECT quantity,payment_description FROM supply_payment  WHERE request_id='$id' ";
          $qury=mysqli_query($con,$sel);
          $rowC=mysqli_fetch_array($qury);
           $quantity= $rowC['quantity'];
           $payment_description= $rowC['payment_description'];

$sel2="SELECT stock FROM stock  WHERE product_category='$payment_description' AND color='$color'";
          $qury2=mysqli_query($con,$sel2);
          $rowD=mysqli_fetch_array($qury2);
         $quantity2= $rowD['stock'];

         $totalstock = $quantity +  $quantity2;
           

$update1="UPDATE stock SET stock =$totalstock WHERE product_category='$payment_description' AND color='$color'";
    mysqli_query($con,$update1);


if(mysqli_query($con,$update)){
    $update1="UPDATE request SET request_status = 'Closed' WHERE id = '$id' ";
    mysqli_query($con,$update1);

    $response['status']=1;
    $response['message']='Approved successfully, Stock increased';

}else{
    $response['status']=0;
    $response['message']='Please try again';

}
echo json_encode($response);
}
?>