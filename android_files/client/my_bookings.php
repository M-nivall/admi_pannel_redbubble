<?php

include '../../include/connections.php';

$clientID = $_POST['clientID'];

// Creating a query to fetch unique orders for the specified client
$select = "SELECT order_id,client_id,total_cost,payment_code,order_date,expected_date,order_status
           FROM bookings  
           WHERE client_id = '$clientID' AND order_status IN ('1','2','3','4','5','6','7','8','9','10','11')
           ORDER BY order_id DESC";

$query = mysqli_query($con, $select);

if (mysqli_num_rows($query) > 0) {
    $results = array();
    $results['status'] = "1";
    $results['orders'] = array();
    $results['message'] = "Booking history";
    
    while ($row = mysqli_fetch_array($query)) {
        $temp = array();

        $temp['orderID'] = $row['order_id'];
        $temp['totalCost'] = $row['total_cost'];
        $temp['paymentCode'] = $row['payment_code'];
        $temp['orderDate'] = $row['order_date'];
        $temp['expectedDate'] = $row['expected_date'];

        // Convert order_status to a readable status message
        switch ($row['order_status']) {
            case 1:
                $temp['orderStatus'] = "Pending Approval";
                break;
            case 2:
                $temp['orderStatus'] = "Approved";
                break;
            case 3:
                $temp['orderStatus'] = "Paid";
                break;
            case 4:
                $temp['orderStatus'] = "Payment Approved";
                break;
            case 5:
            case 6:
                $temp['orderStatus'] = "Approve Brand Design";
                break;
            case 7:
                $temp['orderStatus'] = "In Progress";
                break;
            case 8:
                $temp['orderStatus'] = "Completed";
                break;
            case "9":
                $temp['orderStatus'] = "In shipment";
                break;
            case "10":
                $temp['orderStatus'] = "Delivered";
                break;
                case "11":
                $temp['orderStatus'] = "Completed";
                break;
            default:
                $temp['orderStatus'] = "In Progress";
        }

        array_push($results['orders'], $temp);
    }
} else {
    $results['status'] = "0";
    $results['message'] = "No Booking Found";
}

// Displaying the result in JSON format
echo json_encode($results);

?>
