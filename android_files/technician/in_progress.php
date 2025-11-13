<?php

include '../../include/connections.php';

 if($_SERVER['REQUEST_METHOD']=='POST'){
    $techID=$_POST['techID'];


//creating a query
$select = "SELECT b.order_id,b.client_id,b.county,b.town,b.address,b.expected_date,b.order_date,
          c.first_name,c.last_name,c.phone_no 
          FROM bookings b 
          INNER JOIN payment p ON b.order_id = p.order_id
          RIGHT JOIN clients c ON b.client_id = c.client_id 
          INNER JOIN design_assignments d ON b.order_id = d.order_id
          WHERE d.tech_status='In progress' AND d.tech_id = '$techID' AND b.order_status IN ('7') ORDER BY d.order_id DESC";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['details'] = array();
      $results['message']="Bookings";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['orderID'] = $row['order_id'];
          $temp['clientID'] = $row['client_id'];
          $temp['county'] = $row['county'];
          $temp['town'] = $row['town'];
          $temp['address'] = $row['address'];
          $temp['expectedDate'] = $row['expected_date'];
          $temp['orderDate'] = $row['order_date'];
          $temp['clientName'] = $row['first_name'].' '.$row['last_name'];
          $temp['phoneNo'] = $row['phone_no'];
          $temp['orderStatus'] = "In progress";


          array_push($results['details'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "Nothing  more found";

}
//displaying the result in json format
echo json_encode($results);

 }
?>