<?php

include '../../include/connections.php';


//creating a query
$select = "SELECT b.order_id,b.client_id,b.county,b.town,b.address,b.expected_date,b.order_date,
          c.first_name,c.last_name,c.phone_no 
          FROM bookings b 
          INNER JOIN payment p ON b.order_id = p.order_id
          RIGHT JOIN clients c ON b.client_id = c.client_id WHERE b.order_status='2' AND p.status = '2' ORDER BY b.order_id DESC";

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
          $temp['orderStatus'] = "Pending Allocation";

          array_push($results['details'], $temp);

      }


  }else{
      $results['status'] = "0";
      $results['message'] = "Nothing  more found";

}
//displaying the result in json format
echo json_encode($results);



//$today = date('Ymd');
//$startDate = date('Ymd', strtotime('-100 days'));
//$range = $today - $startDate;
//$rand = rand(100, 999);
//echo $rand;
//echo "</br>";
//$random = substr(md5(mt_rand()), 0, 2);
//echo $random;

?>