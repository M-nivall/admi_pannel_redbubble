<?php
include "../../include/connections.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $orderID = $_POST['orderID'] ?? '';
    $itemsJson = $_POST['items'] ?? '';

    // Validate inputs
    if (empty($orderID) || empty($itemsJson)) {
        echo json_encode([
            'status' => 0,
            'message' => 'Missing required data'
        ]);
        exit;
    }

    // Decode items JSON from Android
    $items = json_decode($itemsJson, true);

    if (!is_array($items)) {
        echo json_encode([
            'status' => 0,
            'message' => 'Invalid items data format'
        ]);
        exit;
    }

    $success = true;
    mysqli_begin_transaction($con);

    try {
        foreach ($items as $item) {
            $category = mysqli_real_escape_string($con, $item['category']);
            $color    = mysqli_real_escape_string($con, $item['color']);
            $qty      = (int)$item['quantity'];

            //  Decrease stock quantity
            $updateStock = "
                UPDATE stock
                SET stock = stock - $qty
                WHERE product_category = '$category' 
                AND color = '$color'
            ";

            if (!mysqli_query($con, $updateStock)) {
                $success = false;
                throw new Exception("Error updating stock for $category - $color");
            }
        }

        // ✅ Update bookings
        $updateBooking = "
            UPDATE bookings 
            SET order_status = '6'
            WHERE order_id = '$orderID'
        ";
        if (!mysqli_query($con, $updateBooking)) {
            $success = false;
            throw new Exception("Error updating bookings");
        }

        // ✅ Update design_assignments
        $updateDesign = "
            UPDATE design_assignments 
            SET stock_release = 'Released'
            WHERE order_id = '$orderID'
        ";
        if (!mysqli_query($con, $updateDesign)) {
            $success = false;
            throw new Exception("Error updating design assignments");
        }

        // ✅ Commit all changes
        mysqli_commit($con);

        echo json_encode([
            'status' => 1,
            'message' => 'Stock released successfully and records updated.'
        ]);

    } catch (Exception $e) {
        mysqli_rollback($con);
        echo json_encode([
            'status' => 0,
            'message' => $e->getMessage()
        ]);
    }
}
?>
