<?php

include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Check if required POST parameters exist
    if (isset($_POST['orderID'])) {

        $orderID = mysqli_real_escape_string($con, $_POST['orderID']);

        $update = "UPDATE bookings SET order_status = '7' WHERE order_id = '$orderID'";

        $update1 = "UPDATE design_assignments SET tech_status = 'In progress' WHERE order_id = '$orderID'";

        if (mysqli_query($con, $update) && mysqli_query($con, $update1)) {
            $response['status'] = 1;
            $response['message'] = 'Wish you a nice work ahead';
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
