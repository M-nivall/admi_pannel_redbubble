<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    include '../../include/connections.php';

    $orderID = $_POST['orderID'];
    $itemId = $_POST['itemId'];
    $originalImgName = $_FILES['filename']['name'];
    $tempName = $_FILES['filename']['tmp_name'];
    $folder = "../upload_designs/";

    $response = array(); // Initialize response array

    // Check if file was uploaded successfully
    if (move_uploaded_file($tempName, $folder . $originalImgName)) {
        // Start transaction
        mysqli_autocommit($con, false);

        // Update design_assignments table
        $query1 = "UPDATE design_assignments 
                  SET assign_status = 'Submited', pdf_design = '$originalImgName' 
                  WHERE order_id = '$orderID'";

        // Update booking table
        $query2 = "UPDATE bookings SET order_status = '4' WHERE order_id = '$orderID'";
    
        //update order_items
        $query3 = "UPDATE order_items SET design_file = '$originalImgName' WHERE item_id = '$itemId' AND order_id = '$orderID'";

        // Execute both queries
        $result1 = mysqli_query($con, $query1);
        $result2 = mysqli_query($con, $query2);
        $result3 = mysqli_query($con, $query3);

        if ($result1 && $result2 && $result3) {
            mysqli_commit($con); // Commit transaction if both queries succeed
            $response['status'] = '1';
            $response['message'] = 'Design submitted successfully, Awaiting Customer Approval';
        } else {
            mysqli_rollback($con); // Rollback transaction if any query fails
            $response['status'] = '0';
            $response['message'] = 'Failed to update records';
        }
    } else {
        $response['status'] = '0';
        $response['message'] = 'Failed to save PDF file';
    }

    // Close connection
    mysqli_close($con);

    // Return JSON response
    echo json_encode($response);
}
?>
