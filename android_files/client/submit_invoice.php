<?php


require_once '../../include/connections.php';



if ($_SERVER['REQUEST_METHOD'] =='POST'){


    $clientID = $_POST['clientID'];
    $orderID = $_POST['orderID'];
    $paymentID = $_POST['paymentID'];
    $paymentCode = $_POST['paymentCode'];
    $paymentMethod = $_POST['paymentMethod'];

    $payment_date = date("Y-m-d");

    $update=" UPDATE service_payment SET mpesa_code = '$paymentCode', payment_mode = '$paymentMethod', 
    payment_date = '$payment_date', status ='1' WHERE order_id = '$orderID' AND payment_id = '$paymentID'";
    if(mysqli_query($con,$update)){

        $update1=" UPDATE bookings SET order_status ='3' WHERE order_id = '$orderID'";
        mysqli_query($con,$update1);

        $response["status"] = 1;
        $response["message"] ='Payment sent Successful, Await Finance Approval';

        echo json_encode($response);
        mysqli_close($con);

    }else{

        $response["status"] = 0;
        $response["message"] ='Failed';

        echo json_encode($response);
        mysqli_close($con);

    }
}
?>



