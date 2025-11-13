<?php


include '../../include/connections.php';

$userID=$_POST["userID"];
$select="SELECT * FROM request WHERE request_status='Active' ORDER BY id DESC";
$query=mysqli_query($con,$select);
if(mysqli_num_rows($query)>0){
    $response['status']=1;
    $response['details']=array();
    $response['message']='Request';
while($row=mysqli_fetch_array($query)){
    $index["requestID"]=$row["id"];
    $index["items"]=$row["items"];
    $index["color"]=$row["color"];
    $index["requestStatus"]=$row["request_status"];
    $index["requestDate"]=$row["request_date"];
    $index["quantity"]=$row["quantity"];

    array_push($response["details"],$index);

}

}else{
    $response['status']=0;
    $response['message']='No Active tender';
}
echo json_encode($response);
