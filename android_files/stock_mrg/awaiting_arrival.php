<?php


include '../../include/connections.php';


$select="SELECT * 
    FROM request r 
    INNER JOIN supply_bids s ON r.id = s.request_id 
    INNER JOIN clients c ON s.supplier_id = c.client_id
    WHERE s.bid_status IN ('Supplied')
    ORDER BY s.bid_id DESC";
$query=mysqli_query($con,$select);
if(mysqli_num_rows($query)>0){
    $response['status']=1;
    $response['details']=array();
    $response['message']='Request';
while($row=mysqli_fetch_array($query)){
    $index["requestID"]=$row["id"];
    $index["bidID"]=$row["bid_id"];
    $index["quantity"]=$row["quantity"];
    $index["unitPrice"]=$row["unit_price"];
    $index["amount"]=$row["total_amount"];
    $index["name"]=$row["first_name"]." ".$row["last_name"];
    $index["phoneNo"]=$row["phone_no"];
    $index["items"]=$row["items"];
    $index["color"]=$row["color"];
    $index["requestStatus"]=$row["bid_status"];
    $index["requestDate"]=$row["request_date"];
    //$index["amount"]=$row["amount"];

    array_push($response["details"],$index);

}

}else{
    $response['status']=0;
    $response['message']='Nothing Found ,Please Request Stock';
}
echo json_encode($response);
