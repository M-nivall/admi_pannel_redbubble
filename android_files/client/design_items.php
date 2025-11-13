<?php
include '../../include/connections.php';

//header('Content-Type: application/json');

$itemId = $_POST['itemId'];
// $packageId = $_POST['packageId'];

$select = mysqli_query($con, "SELECT product_id, print_area, dimension, quantity, color, notes, design_file, file_name, design_status FROM order_items WHERE item_id = '$itemId'");
if (mysqli_num_rows($select)> 0) {
    $response['status'] = 1;
    $response['responseData'] = array();
    while ($row = mysqli_fetch_array($select)) {
        $index['productId'] = $row['product_id'];
        $index['quantity'] = $row['quantity'];
        $index['printArea'] = $row['print_area'];
        $index['dimension'] = $row['dimension'];
        $index['notes'] = $row['notes'];
        $index['designFile'] = $row['design_file'];
        $index['fileName'] = $row['file_name'];
        $index['designStatus'] = $row['design_status'];
        array_push($response['responseData'], $index);
    }
} else {
    $response['status'] = '0';
    $response['message'] = " ";
}
print json_encode($response);