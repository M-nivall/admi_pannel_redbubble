<?php

include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Check if required POST parameters exist
    if (isset($_POST['orderID']) && isset($_POST['remarks'])) {

        $orderID = mysqli_real_escape_string($con, $_POST['orderID']);
        $remarks = mysqli_real_escape_string($con, $_POST['remarks']);

        // Update query
        $update = "UPDATE tech_assignments SET assign_status = 'Completed' WHERE order_id = '$orderID'";

        if (mysqli_query($con, $update)) {

            $update1 = "UPDATE bookings SET order_status = '9', order_remark = '$remarks' WHERE order_id = '$orderID'";
            (mysqli_query($con, $update1));

            $response['status'] = 1;
            $response['message'] = 'Confirmed Successfully, Awaiting Client Confirmation';
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
