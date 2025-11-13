<?php


include '../../include/connections.php';


$select="SELECT d.order_id,d.tech_id,d.date_assigned,e.f_name,e.l_name,c.first_name,c.last_name
    FROM design_assignments d 
    INNER JOIN employees e ON d.tech_id = e.emp_id
    INNER JOIN bookings b ON d.order_id = b.order_id
    INNER JOIN clients c ON b.client_id = c.client_id
    WHERE d.client_approval='Approved' AND d.stock_release='Pending release'
    ORDER BY d.order_id DESC";
$query=mysqli_query($con,$select);
if(mysqli_num_rows($query)>0){
    $response['status']=1;
    $response['details']=array();
    $response['message']='Request';
while($row=mysqli_fetch_array($query)){
    $index["orderID"]=$row["order_id"];
    $index["techName"]=$row["f_name"]." ".$row["l_name"];
    $index["dateAssigned"]=$row["date_assigned"];
    $index["clientName"]=$row["first_name"]." ".$row["last_name"];
    $index["releaseState"]="Pending Release";
    array_push($response["details"],$index);

}

}else{
    $response['status']=0;
    $response['message']='Nothing more found';
}
echo json_encode($response);
