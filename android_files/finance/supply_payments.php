<?php

include '../../include/connections.php';

$select = "
    SELECT 
        p.id,
        p.request_id,
        p.supplier_id,
        p.amount,
        p.payment_description,
        p.payment_status,
        p.payment_date,
        c.first_name,
        c.last_name
    FROM supply_payment p
    INNER JOIN supply_bids s 
        ON p.request_id = s.request_id 
        AND p.supplier_id = s.supplier_id
    INNER JOIN clients c 
        ON c.client_id = p.supplier_id
    WHERE p.payment_status = 'unpaid'
        AND s.bid_status = 'Confirmed Supply'
    ORDER BY p.id DESC
";

$query = mysqli_query($con, $select);

$results = array();
$results['details'] = array();

if (mysqli_num_rows($query) > 0) {

    $results['status'] = "1";
    $results['message'] = "Order history";

    while ($row = mysqli_fetch_assoc($query)) {

        $temp = array(
            'id' => $row['id'],
            'requestID' => $row['request_id'],
            'supplierName' => $row['first_name'] . ' ' . $row['last_name'],
            'supplierID' => $row['supplier_id'],
            'amount' => $row['amount'],
            'payment_description' => $row['payment_description'],
            'payment_status' => $row['payment_status'],
            'payment_date' => $row['payment_date']
        );

        $results['details'][] = $temp;
    }

} else {
    $results['status'] = "0";
    $results['message'] = "No More Pending Payments Found";
}

echo json_encode($results);

?>
