<?php

include '../../include/connections.php';


//creating a query
$select = "SELECT t.order_id,t.date_assigned,t.pdf_design,b.client_id,b.business_name,b.serv_name,b.dimension,b.service_desc,b.installation_type,
     b.input_text,b.sketch_img,b.logo_img,b.expected_date,b.order_date,b.order_status,b.order_date,b.county_id,
     b.town_id,b.address,b.expected_date,
          c.first_name,c.last_name,c.phone_no
          FROM tech_assignments t
          INNER JOIN bookings b ON t.order_id = b.order_id
          INNER JOIN tools_requests r ON r.order_id = t.order_id 
          RIGHT JOIN clients c ON b.client_id = c.client_id WHERE t.assign_status = 'Pending' AND r.request_status = 'Approved' AND b.order_status = '8' ORDER BY b.order_id DESC";

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
          $temp['phone_no'] = $row['phone_no'];
          $temp['orderDate'] = $row['order_date'];
          $temp['address'] = $row['address'];
          $temp['expected_date'] = $row['expected_date'];
          $temp['pdf_design'] = $row['pdf_design'];
          $temp['orderStatus'] = $row['order_status'];

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

?>