<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include '../../include/connections.php';

    $clientID     = $_POST['clientID'];
    $orderID      = $_POST['orderID'];
    $countyName   = $_POST['countyName'];
    $townName     = $_POST['townName'];
    $address      = $_POST['address'];
    $deliveryCost = $_POST['shippingCost'];
    $totalCost    = $_POST['totalCost'];
    $orderCost    = $_POST['orderCost'];
    $mpesaCode    = $_POST['mpesaCode'];
    $paymentMethod    = $_POST['paymentMethod'];
    $expectedDate    = $_POST['expectedDate'];

    // 1. Delivery table check
    $check = mysqli_query($con, "SELECT * FROM delivery WHERE client_id='$clientID'");
    if (mysqli_num_rows($check) > 0) {
        $sql = "UPDATE delivery 
                SET county='$countyName', town='$townName', address='$address' 
                WHERE client_id='$clientID'";
        mysqli_query($con, $sql);
    } else {
        $sql = "INSERT INTO delivery (client_id, county, town, address) 
                VALUES ('$clientID','$countyName','$townName','$address')";
        mysqli_query($con, $sql);
    }

    // 2. Update bookings
    $sql = "UPDATE bookings 
            SET shipping_cost='$deliveryCost', total_cost='$totalCost', 
                order_cost='$orderCost', payment_code='$mpesaCode', expected_date = '$expectedDate',
                county='$countyName', town='$townName', address='$address', order_status = '1'
            WHERE order_id='$orderID' AND client_id='$clientID'";
    mysqli_query($con, $sql);

    // 3. Update order_items
    $sql = "UPDATE order_items 
            SET item_status='1' 
            WHERE order_id='$orderID' AND client_id='$clientID'";
    mysqli_query($con, $sql);

    // 4. Insert payment
    $sql = "INSERT INTO payment(order_id, payment_method, mpesa_code, client_id, order_cost, delivery_cost, total_cost) 
            VALUES ('$orderID', '$paymentMethod','$mpesaCode','$clientID','$orderCost','$deliveryCost','$totalCost')";
    if (mysqli_query($con, $sql)) {
        $result['status'] = "1";
        $result['message'] = "Thank you for your order";
    } else {
        $result['status'] = "0";
        $result['message'] = "Failed to insert payment";
    }

    echo json_encode($result);

} else {
    $result['status'] = "0";
    $result['message'] = "Invalid request method";
    echo json_encode($result);
}
