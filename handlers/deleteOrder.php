<?php
session_start();
include('../connection.php');

// check if its a post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // check if the order id is set
    if (isset($_POST['orderId'])) {
        // get the order id
        $orderId = $_POST['orderId'];
        // delete the order
        $deleteOrder = mysqli_query($con, "DELETE FROM orders WHERE orderid = '$orderId'");
        // check if the order was deleted
        if ($deleteOrder) {
            // return success
            echo 'success';
        } else {
            // return error
            echo 'error';
        }
    } else {
        // return error
        echo 'error';
    }
} else {
    // return error
    echo 'error';
}