<?php

include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Check if required POST parameters exist
    if (isset($_POST['orderID']) && isset($_POST['feedback']) && isset($_POST['itemId'])) {

        $orderID = mysqli_real_escape_string($con, $_POST['orderID']);
        $feedback = mysqli_real_escape_string($con, $_POST['feedback']);
        $itemId = mysqli_real_escape_string($con, $_POST['itemId']);

        // Update query
        $update = "UPDATE design_assignments SET client_approval = 'Approved', client_fb = '$feedback' WHERE order_id = '$orderID'";

        $update1 = "UPDATE order_items SET design_status = 'Approved', client_comment = '$feedback' WHERE item_id = '$itemId' AND order_id = '$orderID'";

        $update2 = "UPDATE bookings SET order_status = '5' WHERE order_id = '$orderID'";

        if (mysqli_query($con, $update) && mysqli_query($con, $update1) && mysqli_query($con, $update2)) {
            $response['status'] = 1;
            $response['message'] = 'Approved Successfully';
        } else {
            $response['status'] = 0;
            $response['message'] = 'Database update failed: ' . mysqli_error($con);
        }
    } else {
        $response['status'] = 0;
        $response['message'] = 'Missing required parameters';
    }
} else {
    $response['status'] = 0;
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
?>
