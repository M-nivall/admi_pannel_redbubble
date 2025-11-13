<?php

include '../../include/connections.php';


//creating a query
$select = "SELECT b.order_id,b.serv_name,b.order_status,b.order_date,b.expected_date,b.county_id,b.town_id,b.address,b.order_remark,
c.first_name,c.last_name,e.f_name,e.l_name,p.status 
    FROM bookings b 
    INNER JOIN service_payment p on b.order_id = p.order_id
    INNER JOIN tech_assignments t ON b.order_id = t.order_id
    INNER JOIN employees e ON t.emp_id = e.emp_id
    RIGHT JOIN clients c on b.client_id = c.client_id WHERE b.order_status='9' AND b.completion_status = 'Pending'  ORDER BY b.order_id DESC";

  $query=mysqli_query($con,$select);
  if(mysqli_num_rows($query)>0){
      $results= array();
      $results['status'] = "1";
      $results['details'] = array();
      $results['message']="Completed Services";
      while ($row=mysqli_fetch_array($query)){
          $temp = array();

          $temp['orderID'] = $row['order_id'];
          $temp['servName'] = $row['serv_name'];
          $temp['clientName'] = $row['first_name'].' '.$row['last_name'];
          $temp['orderDate'] = $row['order_date'];
          $temp['expectedDate'] = $row['expected_date'];
          $temp['address'] = $row['address'];
          $temp['techName'] = $row['f_name'].' '.$row['l_name'];
          $temp['orderRemark'] = $row['order_remark'];
          $temp['orderStatus'] = "Completed";

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