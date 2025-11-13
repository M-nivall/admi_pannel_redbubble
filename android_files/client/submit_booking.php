<?php

include '../../include/connections.php';

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// Handle incoming POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Retrieve POST data
    $clientID = $_POST['userID'];
    $orderID = $_POST['order_id'];
    $countyID = $_POST['countyID'];
    $townName = $_POST['townName'];
    $address = $_POST['address'];
    $bussName = $_POST['bussName'];
    $size = $_POST['size'];
    $service_desc = $_POST['service_desc'];
    $install_type = $_POST['install_type'];
    $input_text = $_POST['input_text'];
    $expected_date = $_POST['expected_date'];
    $product_name = $_POST['product_name'];

    // Validate required fields
    if (empty($clientID) || empty($countyID) || empty($townName) || empty($address)) {
        echo json_encode(["status" => 0, "message" => "Required fields are missing"]);
        exit;
    }

    // File upload handling
    $uploadDir = 'uploads/';
    $sketchImageName = null;
    $logoImageName = null;

    // Function to save file and return its name
    function saveUploadedFile($fileKey, $uploadDir) {
        if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] === UPLOAD_ERR_OK) {
            $fileName = uniqid() . '_' . basename($_FILES[$fileKey]['name']);
            $targetFilePath = $uploadDir . $fileName;
            if (move_uploaded_file($_FILES[$fileKey]['tmp_name'], $targetFilePath)) {
                return $fileName; // Only return the file name
            }
        }
        return null;
    }

    // Save files and get their names
    $sketchImageName = saveUploadedFile('sketchImage', $uploadDir);
    $logoImageName = saveUploadedFile('logoImage', $uploadDir);


                    // get town id
                    $slect = "SELECT town_id FROM towns WHERE town_name='$townName' AND county_id='$countyID'";
                    $query = mysqli_query($con, $slect);
                    $row = mysqli_fetch_array($query);
                    $townID = $row['town_id'];


                    // check if client has already submitted delivery details
                    //if has not enter the delivery details entered by the client

                    $select = "SELECT * FROM delivery WHERE client_id='$clientID'";
                    $query = mysqli_query($con, $select);
                    if (mysqli_num_rows($query) < 1) {
                        // insert the delivery details
                        $insert = "INSERT INTO delivery(county_id, town_id, client_id,address) VALUES ('$countyID','$townID','$clientID','$address')";
                        mysqli_query($con, $insert);

                    } else {

                        // if user had submitted delivery details update delivery details in case user change delivery details
                        $update = "UPDATE delivery SET county_id='$countyID',town_id='$townID',address='$address'WHERE client_id='$clientID'";
                        mysqli_query($con, $update);

                    }


                    // update client order status and insert delivery details

                    // get current date
                    $update = "UPDATE bookings SET business_name='$bussName',serv_name='$product_name',dimension='$size',service_desc='$service_desc',
                    installation_type='$install_type',input_text='$input_text',expected_date='$expected_date',
                    county_id='$countyID',town_id='$townID',address='$address',sketch_img ='$sketchImageName',logo_img='$logoImageName',
                    order_date=CURRENT_TIMESTAMP,order_status='1'
                    WHERE order_id='$orderID'AND client_id='$clientID'";
                    if (mysqli_query($con, $update)) {

                        // if order status updated statusfully update order items status
                        $update = "UPDATE order_items SET item_status='1' WHERE order_id='$orderID'";
                        mysqli_query($con, $update);

                        echo json_encode(["status" => 1, "message" => "Booking submited successfully"]);

                    }

         else {
        echo json_encode(["status" => 0, "message" => "Failed to update booking: " . mysqli_error($con)]);
    }
}

mysqli_close($con);

?>
