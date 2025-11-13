<?php

include '../../include/connections.php';

//$supplier=$_POST['supplier'];
$productName=$_POST['productName'];
$productColor=$_POST['productColor'];
$quantity=$_POST['quantity'];

$request_date = date("Y-m-d");

   $insert="INSERT INTO request (items, color, quantity, request_date)VALUES ('$productName','$productColor','$quantity', '$request_date')";
  if(mysqli_query($con,$insert)){
    $response['status']=1;
    $response['message']='Tender Reques sent successfully';
    }else{
    $response['status']=0;
    $response['message']='Please try again. Something went wrong';
  }
echo json_encode($response);
