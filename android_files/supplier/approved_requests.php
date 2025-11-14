<?php


include '../../include/connections.php';

$userID=$_POST["userID"];

$select="SELECT * FROM request r 
    INNER JOIN supply_bids s ON r.id = s.request_id 
    WHERE s.bid_status = 'Approved' and s.supplier_id = '$userID' ORDER BY r.id DESC";
$query=mysqli_query($con,$select);
if(mysqli_num_rows($query)>0){
    $response['status']=1;
    $response['details']=array();
    $response['message']='Approved Requests';
while($row=mysqli_fetch_array($query)){

    $index["requestID"]=$row["id"];
     $index["bidID"]=$row["bid_id"];
    $index["items"]=$row["items"];
    $index["color"]=$row["color"];
    $index["requestStatus"]=$row["bid_status"];
    $index["requestDate"]=$row["request_date"];
    $index["quantity"]=$row["quantity"];

    $index["unitPrice"]=$row["unit_price"];
    $index["totalAmount"]=$row["total_amount"];

    array_push($response["details"],$index);

}

}else{
    $response['status']=0;
    $response['message']='No Active tender';
}
echo json_encode($response);
