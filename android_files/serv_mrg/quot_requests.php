<?php

include '../../include/connections.php';


//creating a query
$select = "SELECT b.order_id,b.client_id,b.business_name,b.serv_name,b.dimension,b.service_desc,b.installation_type,
     b.input_text,b.sketch_img,b.logo_img,b.expected_date,b.order_date,b.order_status,b.order_date,b.county_id,
     b.town_id,b.address,
          c.first_name,c.last_name 
          FROM bookings b 
          RIGHT JOIN clients c on b.client_id = c.client_id WHERE b.order_status='1' ORDER BY b.order_id DESC";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['details'] = array();
      $results['message']="Order to ship";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['orderID'] = $row['order_id'];
          $temp['clientID'] = $row['client_id'];
          $temp['business_name'] = $row['business_name'];
          $temp['serv_name'] = $row['serv_name'];
          $temp['dimension'] = $row['dimension'];
          $temp['service_desc'] = $row['service_desc'];
          $temp['installation_type'] = $row['installation_type'];
          $temp['input_text'] = $row['input_text'];
          $temp['sketch_img'] = $row['sketch_img'];
          $temp['logo_img'] = $row['logo_img'];
          $temp['expected_date'] = $row['expected_date'];
          $temp['clientName'] = $row['first_name'].' '.$row['last_name'];
          $temp['orderDate'] = $row['order_date'];
          $temp['address'] = $row['address'];
          $temp['orderStatus'] = "Pending";

          // get county

          $sel="SELECT county_name FROM counties WHERE county_id='".$row['county_id']."'";
          $qury=mysqli_query($con,$sel);
          $rowC=mysqli_fetch_array($qury);
          $temp['county'] = $rowC['county_name'];

          // get town name

          $selT="SELECT town_name FROM towns WHERE town_id='".$row['town_id']."'";
          $quryT=mysqli_query($con,$selT);
          $rowT=mysqli_fetch_array($quryT);
          $temp['town'] = $rowT['town_name'];

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