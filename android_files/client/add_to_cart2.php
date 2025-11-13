<?php
// add_to_cart.php
include '../../include/connections.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["status" => 0, "message" => "Invalid request method"]);
    exit;
}

// ---- HELPER: save uploaded file, return only filename ----
function saveUploadedFile($fileKey, $uploadDir = 'uploads/')
{
    if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
        $orig = basename($_FILES[$fileKey]['name']);
        $safeBase = preg_replace('/[^A-Za-z0-9._-]/', '_', $orig);
        $fileName = uniqid('', true) . '_' . $safeBase;
        $target   = rtrim($uploadDir, '/').'/'.$fileName;
        if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $target)) {
            return $fileName;
        }
    }
    return null;
}

// ----------- READ POST (direct style) -----------
$clientID    = $_POST['clientID'];
$clientName  = $_POST['clientName'];   
$clientEmail = $_POST['clientEmail'];  
$clientPhone = $_POST['clientPhone'];  

$productID   = $_POST['productID'];
$productName = $_POST['productName'];
$category = $_POST['category'];
$unitPrice   = $_POST['unitPrice'];   
$quantity    = $_POST['quantity'];    
$totalPrice  = $_POST['totalPrice'];  

//$printType = $_POST['printType'];
$printArea   = $_POST['printArea'];
$color       = $_POST['color'];
$size        = $_POST['size'];        // stored as 'dimension'
$notes       = $_POST['notes'];

$logoImageName = saveUploadedFile('logoImage', 'uploads/');

// ----------- 1) Find or create a PENDING booking (order_status = 0) ----------
$sqlFindPending = "SELECT order_id FROM bookings WHERE client_id = ? AND order_status = 0 ORDER BY order_date DESC LIMIT 1";
$stmtFind = $con->prepare($sqlFindPending);
$stmtFind->bind_param('s', $clientID);
$stmtFind->execute();
$stmtFind->bind_result($existingOrderId);
$hasPending = $stmtFind->fetch();
$stmtFind->close();

if ($hasPending && $existingOrderId > 0) {
    $orderId = $existingOrderId;
} else {
    $sqlBook = "INSERT INTO bookings (client_id, order_date, order_status) VALUES (?, CURRENT_TIMESTAMP, 0)";
    $stmt1 = $con->prepare($sqlBook);
    $stmt1->bind_param('s', $clientID);
    $stmt1->execute();
    $orderId = $stmt1->insert_id;
    $stmt1->close();

    if ($orderId <= 0) {
        echo json_encode(["status" => 0, "message" => "Failed to create booking"]);
        exit;
    }
}

// ----------- 2) Prevent duplicate product in the same pending order ----------
$sqlExists = "SELECT 1 FROM order_items 
              WHERE order_id = ? AND product_id = ? AND item_status = 0 
              LIMIT 1";
$stmtEx = $con->prepare($sqlExists);
$stmtEx->bind_param('is', $orderId, $productID);
$stmtEx->execute();
$stmtEx->store_result();
$alreadyInCart = ($stmtEx->num_rows > 0);
$stmtEx->close();

if ($alreadyInCart) {
    echo json_encode([
        "status"   => 2,
        "message"  => "Item already in cart for this pending order",
        "order_id" => $orderId,
        "fileName" => $logoImageName
    ]);
    $con->close();
    exit;
}

// ----------- 3) Insert new cart line (let DB default item_status = 0) --------
$sqlItem = "INSERT INTO order_items
(order_id, client_id, product_id, product_name, item_price, quantity, total_price,
 print_area, color, dimension, notes, file_name, category)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt2 = $con->prepare($sqlItem);
$stmt2->bind_param(
    'issssssssssss',
    $orderId,
    $clientID,
    $productID,
    $productName,
    $unitPrice,
    $quantity,
    $totalPrice,
    $printArea,
    $color,
    $size,         
    $notes,
    $logoImageName,
    $category
);

$stmt2->execute();
$ok2 = ($stmt2->affected_rows > 0);
$stmt2->close();

if (!$ok2) {
    echo json_encode(["status" => 0, "message" => "Failed to add order item"]);
    $con->close();
    exit;
}

// ----------- SUCCESS -----------
echo json_encode([
    "status"   => 1,
    "message"  => "Item added to cart",
    "order_id" => $orderId,
    "fileName" => $logoImageName
]);

$con->close();
