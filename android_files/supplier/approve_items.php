<?php
include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $requestID   = $_POST['requestID'];
    $userID      = $_POST['userID'];
    $unitPrice   = $_POST['unitPrice'];
    $totalAmount = $_POST['totalAmount'];

    // Check if supplier already placed a bid for this request
    $check = "SELECT * FROM supply_bids WHERE supplier_id = '$userID' AND request_id = '$requestID'";
    $result = mysqli_query($con, $check);

    if (mysqli_num_rows($result) > 0) {
        // Supplier already placed a bid
        $response['status'] = 0;
        $response['message'] = 'You have already submitted a bid for this request.';
        echo json_encode($response);
        exit();
    }

    // Fetch request details
    $select = "SELECT * FROM request WHERE id = '$requestID'";
    $record = mysqli_query($con, $select);
    $rowC = mysqli_fetch_assoc($record);

    if (!$rowC) {
        $response['status'] = 0;
        $response['message'] = 'Request not found.';
        echo json_encode($response);
        exit();
    }

    $items    = $rowC['items'];
    $quantity = $rowC['quantity'];

    // Insert into supply_bids first
    $insertBid = "INSERT INTO supply_bids (supplier_id, request_id, quantity, unit_price, total_amount)
                  VALUES ('$userID', '$requestID', '$quantity', '$unitPrice', '$totalAmount')";

    if (mysqli_query($con, $insertBid)) {

        // Then insert into supply_payment
        $insertPayment = "INSERT INTO supply_payment (supplier_id, amount, payment_description, quantity, request_id)
                          VALUES ('$userID', '$totalAmount', 'Payment for $items', '$quantity', '$requestID')";

        if (mysqli_query($con, $insertPayment)) {
            $response['status'] = 1;
            $response['message'] = 'Bid Requested succesfully. Awaiting Approval.';
        } else {
            $response['status'] = 0;
            $response['message'] = 'Bid saved but failed to create payment record.';
        }

    } else {
        $response['status'] = 0;
        $response['message'] = 'Failed to submit your bid. Please try again.';
    }

    echo json_encode($response);
}
?>
