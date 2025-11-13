<?php

include '../../include/connections.php';

//creating a query
$select = "SELECT b.order_id,b.client_id,b.order_cost,b.shipping_cost,b.total_cost,b.payment_code,b.county,b.town,b.address,
    b.expected_date,b.order_date,p.payment_method,p.payment_id,c.first_name,c.last_name,c.phone_no,c.email
          FROM bookings b 
          INNER JOIN payment p ON b.order_id = p.order_id
          INNER JOIN design_assignments d ON b.order_id = d.order_id
          RIGHT JOIN clients c on b.client_id = c.client_id 
          WHERE p.status='2' AND b.order_status = '8' AND d.tech_status = 'Completed' ORDER BY b.order_id DESC";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['details'] = array();
      $results['message']="Order history";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['orderID'] = $row['order_id'];
          $temp['paymentID'] = $row['payment_id'];
          $temp['clientName'] = $row['first_name'].' '.$row['last_name'];
          $temp['phoneNo'] = $row['phone_no'];
          $temp['email'] = $row['email'];
          $temp['paymentCode'] = $row['payment_code'];
          $temp['paymentMethod'] = $row['payment_method'];
          $temp['orderDate'] = $row['order_date'];
          $temp['totalAmount'] = $row['total_cost'];
          $temp['paymentStatus'] = "Pending delivery";

          $temp['county'] = $row['county'];
          $temp['town'] = $row['town'];
          $temp['address'] = $row['address'];

          array_push($results['details'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "No record found";

}
//displaying the result in json format
echo json_encode($results);



?>