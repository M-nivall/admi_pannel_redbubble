<?php

include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Check if required POST parameters exist
    if (isset($_POST['orderID']) && isset($_POST['feedback'])) {

        $orderID = mysqli_real_escape_string($con, $_POST['orderID']);
        $feedback = mysqli_real_escape_string($con, $_POST['feedback']);

        // Update query
        $update = "UPDATE design_assignments SET client_approval = 'Rejected', client_fb = '$feedback' WHERE order_id = '$orderID'";

        if (mysqli_query($con, $update)) {
            $response['status'] = 1;
            $response['message'] = 'Rejected Successfully';
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
