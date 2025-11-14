<?php
include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $requestID   = $_POST['requestID'];
    $userID      = $_POST['userID'];
    $bidID   = $_POST['bidID'];


    
    $update="UPDATE supply_bids SET bid_status = 'Supplied' WHERE bid_id = '$bidID' ";
    if (mysqli_query($con, $update)) {

            $response['status'] = 1;
            $response['message'] = 'Supplied succesfully. Awaiting Payment.';

    } else {
        $response['status'] = 0;
        $response['message'] = 'Failed supply. Please try again.';
    }

    echo json_encode($response);
}
?>
